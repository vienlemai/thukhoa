<?php

App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class MenusController extends AppController {
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	public $layout = 'admin/admin';

	public function admin_index() {
		$this->Menu->recursive = 0;
		$categories = $this->Menu->find('all');
		$this->set('menus', $categories);
		$this->set('title_for_layout', 'Menu');
		$this->set('menu_titles', $this->Menu->menu_titles);
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			//var_dump($this->request->data);exit();
			//if (!empty($this->request->data['Menu']['content'])) {
			$menuType = $this->request->data['Menu']['menu_type'];
			$menuTypes = $this->Menu->menu_types;
			$this->request->data['Menu']['controller'] = $menuTypes[$menuType]['controller'];
			$this->request->data['Menu']['action'] = $menuTypes[$menuType]['action'];
			//$this->request->data['Menu']['ext'] = ;
			$this->request->data['Menu']['alias'] = $this->Common->vnit_change_title($this->request->data['Menu']['title']);
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công menu', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng nhập đầy đủ thông tin và thử lại', 'flash_error');
			}
//			} else {
//				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng nhập đầy đủ thông tin và thử lại', 'flash_error');
//			}
		}
		//$parentCategories = $this->Menu->find('list');
		$parentMenus = $this->Menu->find('list', array('conditions' => array('Menu.parent_id' => null)));
		//var_dump($parentCategories);exit();
		$this->set(compact('parentMenus'));
		$this->set('menu_types', $this->Menu->menu_types);
		$this->set('menu_titles', $this->Menu->menu_titles);
		$this->set('title_for_layout', 'Thêm Menu');
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Menu->id = $id;
			$menuType = $this->request->data['Menu']['menu_type'];
			if ($menuType == 1) {
				$this->request->data['Menu']['controller'] = 'posts';
				$this->request->data['Menu']['action'] = 'posts';
			} else if ($menuType == 2) {
				$this->request->data['Menu']['controller'] = 'posts';
				$this->request->data['Menu']['action'] = 'view';
			}
			//$this->request->data['Menu']['ext'] = 'ext';
			$this->request->data['Menu']['alias'] = $this->Common->vnit_change_title($this->request->data['Menu']['title']);
			$menu = $this->Menu->save($this->request->data);
			if ($menu) {
				$this->Session->setFlash('Lưu thành công menu "' . $menu['Menu']['title'] . '"', 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
			$parentMenus = $this->Menu->find('list', array('conditions' => array('Menu.parent_id' => null)));
			//var_dump($parentCategories);exit();
			$this->set(compact('parentMenus'));
			$this->set('menu_titles', $this->Menu->menu_titles);
			$this->set('menu_types', $this->Menu->menu_types);
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
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		$this->loadModel('Post');
		$post = $this->Post->find('count', array('conditions' => array('Post.category_id' => $id)));
		if (!empty($post)) {
			$this->Session->setFlash('Danh mục này đã có bài viết, không thể xóa', 'flash_error');
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->Menu->delete()) {
			$this->loadModel('UserCategory');
			$this->UserCategory->deleteAll(array('UserCategory.category_id' => $id));
			$this->Session->setFlash('Xóa thành công', 'flash_success');
		} else {
			$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function makeActive($id, $status) {
		$this->Menu->id = $id;
		$this->Menu->saveField('is_active', $status);
		$this->redirect('/admin/danh-muc');
	}

	public function admin_listcategories() {
		$this->loadModel('Category');
		$categories = $this->Category->find('all');
		$this->set('categories', $categories);
	}

	public function admin_listposts() {
		$this->loadModel('Post');
		$posts = $this->Post->find('all', array('fields' => array('Post.id', 'Post.title', 'Category.name')));
		$this->set('posts', $posts);
	}

	public function getMainMenu() {
		$this->Menu->unbindModel(array('hasMany' => array('Post'), 'belongsTo' => array('ParentCategory')));
		//$this->Menu->recursive = 4;
		//$menus = $this->Menu->find('all', array('conditions' => array('Category.parent_id' => null), 'fields' => array('Category.id', 'Category.name', 'Category.parent_id', 'Category.alias')));
		$menus = $this->Menu->find('threaded', array('fields' => array('id', 'parent_id', 'name', 'alias')));
		//debug($menus);
		//exit();
		return $menus;
	}

	public function getChildMenu($parent_id) {
		$this->Menu->unbindModel(array('hasMany' => array('Post')));
		$menus = $this->Menu->find('all', array('conditions' => array('Category.parent_id' => $parent_id), 'fields' => array('Category.id', 'Category.name', 'Category.parent_id')));

		return $menus;
	}

	public function firstMenuItem() {

		$this->Menu->unbindModel(array('hasMany' => array('Post', 'ChildCategory')));
		$menu = $this->Menu->read('name', 1);
		$this->loadModel('Post');
		$posts = $this->Post->find('all', array('fields' => array('Post.id', 'Post.title', 'Post.alias'), 'conditions' => array('Post.category_id' => 1)));
		$menu['posts'] = $posts;
		return $menu;
	}

	public function admin_makeUnActive($id) {
		$this->Menu->id = $id;
		$menu = $this->Menu->read(array('title'),$id);
		$this->Menu->saveField('is_active', false);
		$this->Session->setFlash('Menu "'.$menu['Menu']['title'].'" đã được ẩn khỏi trang chủ', 'flash_success');
		$this->redirect('index/index');
	}
	public function admin_makeActive($id) {
		$this->Menu->id = $id;
		$menu = $this->Menu->read(array('title'),$id);
		$this->Menu->saveField('is_active', true);
		$this->Session->setFlash('Menu "'.$menu['Menu']['title'].'" đã được kích hoạt trên trang chủ', 'flash_success');
		$this->redirect('index/index');
	}

	// Xem các bài viết trong danh mục
	public function view($menu_id) {
		$this->loadModel('Post');
	}

}
