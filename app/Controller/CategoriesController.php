<?php

App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	public $layout = 'admin/admin';

	public function admin_index() {
		$this->Category->recursive = 0;
		$categories = $this->Category->find('all');
		$this->set('categories', $categories);
		$this->set('title_for_layout', 'Danh mục');
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			$this->request->data['Category']['alias'] = $this->Common->vnit_change_title($this->request->data['Category']['name']);
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công danh mục', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
		//$parentCategories = $this->Category->find('list');
		$parentCategories = $this->Category->generateTreeList(null, null, null, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		//var_dump($parentCategories);exit();
		$this->set(compact('parentCategories'));
		$this->set('title_for_layout', 'Thêm danh mục');
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//var_dump($this->request->data);exit();
			$this->Category->id = $id;
			$category = $this->Category->save($this->request->data);
			if ($category) {
				$this->Session->setFlash('Lưu thành công danh mục "' . $category['Category']['name'] . '"', 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
			$parentCategories = $this->Category->generateTreeList(null, null, null, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
			$this->set(compact('parentCategories', 'users'));
			$this->set('title_for_layout', 'Sửa danh mục');
		}
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		$this->loadModel('Post');
		$post = $this->Post->find('count', array('conditions' => array('Post.category_id' => $id)));
		if (!empty($post)) {
			$this->Session->setFlash('Danh mục này đã có bài viết, không thể xóa', 'flash_error');
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->Category->delete()) {
			$this->loadModel('UserCategory');
			$this->UserCategory->deleteAll(array('UserCategory.category_id' => $id));
			$this->Session->setFlash('Xóa thành công', 'flash_success');
		} else {
			$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function makeActive($id, $status) {
		$this->Category->id = $id;
		$this->Category->saveField('is_active', $status);
		$this->redirect('/admin/danh-muc');
	}

	public function getMainMenu() {
		$this->Category->unbindModel(array('hasMany' => array('Post'), 'belongsTo' => array('ParentCategory')));
		//$this->Category->recursive = 4;
		//$menus = $this->Category->find('all', array('conditions' => array('Category.parent_id' => null), 'fields' => array('Category.id', 'Category.name', 'Category.parent_id', 'Category.alias')));
		$menus = $this->Category->find('threaded', array('fields' => array('id', 'parent_id', 'name', 'alias')));
		//debug($menus);
		//exit();
		return $menus;
	}

	public function getChildMenu($parent_id) {
		$this->Category->unbindModel(array('hasMany' => array('Post')));
		$menus = $this->Category->find('all', array('conditions' => array('Category.parent_id' => $parent_id), 'fields' => array('Category.id', 'Category.name', 'Category.parent_id')));

		return $menus;
	}

	public function firstMenuItem() {

		$this->Category->unbindModel(array('hasMany' => array('Post', 'ChildCategory')));
		$menu = $this->Category->read('name', 1);
		$this->loadModel('Post');
		$posts = $this->Post->find('all', array('fields' => array('Post.id', 'Post.title', 'Post.alias'), 'conditions' => array('Post.category_id' => 1)));
		$menu['posts'] = $posts;
		return $menu;
	}

	public function admin_makeUnActive($id) {
		$this->Category->id = $id;
		$this->Category->saveField('is_active', false);
		$this->redirect('index/index');
	}

	public function admin_makeActive($id) {
		$this->Category->id = $id;
		$this->Category->saveField('is_active', true);
		$this->redirect('index/index');
	}

}
