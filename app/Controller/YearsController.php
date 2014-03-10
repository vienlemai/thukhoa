<?php

App::uses('AppController', 'Controller');

class YearsController extends AppController {
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	public $layout = 'admin/admin';

	public function admin_index() {
		$years = $this->Year->find('all');
		$this->set('years', $years);
	}

	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Year']['is_active'] = true;
			if ($this->Year->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công năm học ' . $this->request->data['Year']['name'], 'flash_success');
				$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
			} else {
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
			}
		} else {
			$this->set('title_for_layout', 'Thêm năm học');
		}
	}

	public function admin_edit($id) {
		if (!$this->Year->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Year->id = $id;
			if ($this->Year->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công năm học ' . $this->request->data['Year']['name'], 'flash_success');
				$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
			} else {
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
			}
		} else {
			$options = array('conditions' => array('Year.' . $this->Year->primaryKey => $id));
			$this->set('linkTypes', $this->Year->linkTypes);
			$this->request->data = $this->Year->find('first', $options);
		}
		$this->set('title_for_layout', 'Chỉnh sửa video');
	}

	public function admin_makeActive($id) {
		if (!$this->Year->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		$this->Year->id = $id;
		$this->Year->saveField('is_active', true);
		$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
	}

	public function admin_makeUnActive($id) {
		if (!$this->Year->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		$this->Year->id = $id;
		$this->Year->saveField('is_active', false);
		$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
	}

	public function admin_delete($id) {
		$this->Year->id = $id;
		if (!$this->Year->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Year->delete()) {
			$this->Session->setFlash('Xóa thành công năm học', 'flash_success');
		} else {
			$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
		}
		$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
	}

	public function getYears() {
		$linkTypes = $this->Year->linkTypes;
		$years = array();
		foreach ($linkTypes as $k => $v) {
			$years[$k]['years'] = $this->Year->find('all', array('conditions' => array('Year.type' => $k)));
			$years[$k]['type'] = $v;
		}
		return $years;
	}

}

?>
