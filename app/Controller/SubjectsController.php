<?php

App::uses('AppController', 'Controller');

class SubjectsController extends AppController {
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	public $layout = 'admin/admin';

	public function admin_index() {
		$subjects = $this->Subject->find('all');
		$this->set('subjects', $subjects);
	}

	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Subject']['is_active'] = true;
			if ($this->Subject->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công môn học ' . $this->request->data['Subject']['name'], 'flash_success');
				$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
			} else {
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
			}
		} else {
			$this->set('title_for_layout', 'Thêm môn học');
		}
	}

	public function admin_edit($id) {
		if (!$this->Subject->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Subject->id = $id;
			if ($this->Subject->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công môn học ' . $this->request->data['Subject']['name'], 'flash_success');
				$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
			} else {
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
			}
		} else {
			$options = array('conditions' => array('Subject.' . $this->Subject->primaryKey => $id));
			$this->set('linkTypes', $this->Subject->linkTypes);
			$this->request->data = $this->Subject->find('first', $options);
		}
		$this->set('title_for_layout', 'Chỉnh sửa video');
	}

	public function admin_makeActive($id) {
		if (!$this->Subject->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		$this->Subject->id = $id;
		$this->Subject->saveField('is_active', true);
		$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
	}

	public function admin_makeUnActive($id) {
		if (!$this->Subject->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		$this->Subject->id = $id;
		$this->Subject->saveField('is_active', false);
		$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
	}

	public function admin_delete($id) {
		$this->Subject->id = $id;
		if (!$this->Subject->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Subject->delete()) {
			$this->Session->setFlash('Xóa thành công môn học', 'flash_success');
		} else {
			$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
		}
		$this->redirect(array('controller' => 'setting', 'action' => 'view', 'admin' => true));
	}

	public function getSubjects() {
		$linkTypes = $this->Subject->linkTypes;
		$subjects = array();
		foreach ($linkTypes as $k => $v) {
			$subjects[$k]['subjects'] = $this->Subject->find('all', array('conditions' => array('Subject.type' => $k)));
			$subjects[$k]['type'] = $v;
		}
		return $subjects;
	}

}

?>
