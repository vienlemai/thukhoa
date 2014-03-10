<?php

App::uses('AppController', 'Controller');

/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class ConfidentialsController extends AppController {
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	public $layout = 'admin/admin';

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->paginate = array('order'=>'created DESC');
		$this->set('confidentials', $this->Paginator->paginate());
		$this->set('title_for_layout', 'Tâm sự thầy trò');
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Confidential->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Confidential.' . $this->Confidential->primaryKey => $id));
		$this->set('confidential', $this->Confidential->find('first', $options));
	}

	public function admin_makeActive($id) {
		$this->Confidential->id = $id;
		$confidential = $this->Confidential->read(array('id', 'title'), $id);
		$this->Confidential->saveField('is_active', 1);
		$this->Session->setFlash('Bài viết "' . $confidential['Confidential']['title'] . '" đã được hiển thị trên trang web','flash_success');
		$this->redirect(array('action'=>'index'));
	}

	public function admin_makeUnactive($id) {
		$this->Confidential->id = $id;
		$confidential = $this->Confidential->read(array('id', 'title'), $id);
		$this->Confidential->saveField('is_active', 0);
		$this->Session->setFlash('Bài viết "' . $confidential['Confidential']['title'] . '" đã được ẩn khỏi trang web','flash_success');
		$this->redirect(array('action'=>'index'));
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Confidential->id = $id;
		if (!$this->Confidential->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->onlyAllow('post', 'delete');
		$confidential = $this->Confidential->read(array('id', 'title'), $id);
		$this->Confidential->saveField('is_active', 0);
		if ($this->Confidential->delete()) {
			$this->Session->setFlash('Xóa thành công bài viết "'.$confidential['Confidential']['title'].'"', 'flash_success');
		} else {
			$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function index() {
		if ($this->request->isAjax) {
			$this->layout = null;
		} else {
			$this->layout = 'frontend/detailArticle';
		}
		$conditions['AND'] = array('Confidential.is_active' => 1);
		$this->paginate = array(
			'limit' => 5,
			'maxLimit' => 50,
			'conditions' => $conditions,
			'order' => array(
				'Confidential.modified' => 'DESC'
			),
		);
		$confidentials = $this->paginate();
		$this->set('confidentials', $confidentials);
	}

	/*
	 * Add confidential 
	 */

	public function add() {
		$this->layout = false;
		$this->autoRender = false;
		$result = array();
		$result['status'] = 0;
		$result['message'] = 'Đã có lỗi xảy ra, vui lòng thử lại';
		$this->request->data['Confidential']['is_active'] = false;
		$this->Confidential->set($this->request->data);
		if ($this->Confidential->validates()) {
			$this->Confidential->create();
			if ($this->Confidential->save($this->request->data)) {
				$result['status'] = 1;
				$result['message'] = 'Bài đăng của bạn đã được gửi đi, đang chờ Admin kiểm duyệt';
			}
		} else {
			$errors = $this->Confidential->validationErrors;
			foreach ($errors as $k => $v) {
				$result['message'] = $v[0];
				break;
			}
		}
		return json_encode($result);
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->layout = 'frontend/detailArticle';
		if (!$this->Confidential->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Confidential.' . $this->Confidential->primaryKey => $id));
		$article = $this->Confidential->find('first', $options);
		$this->loadModel('Category');
		$this->Category->recursive = 1;
		$this->Category->unbindModel(array('hasMany' => array('Post')));
		$category = $this->Category->read(null, $article['Post']['category_id']);
		$current_menu_id = $article['Post']['category_id'];
		$conditions['AND'] = array('Confidential.is_active' => 1, 'Confidential.category_id' => $article['Post']['category_id'], 'Confidential.' . $this->Confidential->primaryKey . ' !=' => $id);
		$otherArticle = $this->Confidential->find('all', array('conditions' => $conditions, 'limit' => 5));
		$title_for_layout = $article['Post']['title'];
		$this->set(compact('article', 'otherArticle', 'current_menu_id', 'category', 'title_for_layout'));
	}

	/**
	 * Get the most Recent post
	 *
	 * @param int $limit The number of comments you want
	 * @return Array
	 * */
	public function recent($limit = 7) {
		if (!empty($this->request->params['requested'])) {
			$this->recursive = 1;
			$posts = array();
			$recent = $this->Confidential->find('all', array('limit' => $limit, 'order' => 'Confidential.modified DESC'));
			array_push($posts, $recent);
			$viewMost = $this->Confidential->find('all', array('limit' => $limit, 'order' => 'Confidential.view_count DESC'));
//			$this->log($viewMost, 'debug');
			array_push($posts, $viewMost);
			return $recent;
		}
	}

}
