<?php

App::uses('AppController', 'Controller');

class LinksController extends AppController {
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	public $layout = 'admin/admin';

	public function admin_index() {
		$links = $this->Link->find('all');
		$this->set('links', $links);
	}

	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Link->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công liên kết ' . $this->request->data['Link']['title'], 'flash_success');
				$this->redirect(array('controller' => 'admin', 'action' => 'config', 'admin' => true));
			} else {
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
			}
		} else {
			$linkTypes = $this->Link->linkTypes;
			$this->set('linkTypes', $linkTypes);
			$this->set('title_for_layout', 'Thêm liên kết web');
		}
	}

	public function admin_edit($id) {
		if (!$this->Link->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Link->id = $id;
			if ($this->Link->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công liên kết ' . $this->request->data['Link']['title'], 'flash_success');
				$this->redirect(array('controller' => 'admin', 'action' => 'config', 'admin' => true));
			} else {
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
			}
		} else {
			$options = array('conditions' => array('Link.' . $this->Link->primaryKey => $id));
			$this->set('linkTypes', $this->Link->linkTypes);
			$this->request->data = $this->Link->find('first', $options);
		}
		$this->set('title_for_layout', 'Chỉnh sửa video');
	}

	public function admin_delete($id) {
		$this->Link->id = $id;
		if (!$this->Link->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->onlyAllow('post', 'delete');
		$link = $this->Link->read(array('id', 'title'), $id);
		$this->Link->saveField('is_active', 0);
		if ($this->Link->delete()) {
			$this->Session->setFlash('Xóa thành công liên kết "' . $link['Link']['title'] . '"', 'flash_success');
		} else {
			$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
		}
		$this->redirect(array('controller' => 'admin', 'action' => 'config', 'admin' => true));
	}

	public function getLinks() {
		$linkTypes = $this->Link->linkTypes;
		$links = array();
		foreach ($linkTypes as $k => $v) {
			$links[$k]['links'] = $this->Link->find('all', array('conditions' => array('Link.type' => $k)));
			$links[$k]['type'] = $v;
		}
		return $links;
	}

}

?>
