<?php

App::uses('AppController', 'Controller');

/**
 * Resources Controller
 *
 * @property Resource $Resource
 * @property PaginatorComponent $Paginator
 */
class SchedulesController extends AppController {
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
		$this->Schedule->recursive = 0;
		$this->set('schedules', $this->Schedule->find('all'));
		$this->set('title_for_layout', 'Tài liệu');
		$this->set('schedule_types', $this->Schedule->scheduleTypes);
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Schedule->exists($id)) {
			throw new NotFoundException(__('Invalid resource'));
		}
		$options = array('conditions' => array('Schedule.' . $this->Schedule->primaryKey => $id));
		$this->set('resource', $this->Schedule->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$user = $this->UserAuth->getUser();
			$this->request->data['Schedule']['user_create'] = $user['User']['first_name'];
			$this->request->data['Schedule']['viewed'] = 0;
			$this->request->data['Schedule']['download'] = 0;
			$this->Schedule->create();
			if ($this->Schedule->saveAssociated($this->request->data)) {
				$this->Session->setFlash('Lưu thành công tài liệu', 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				unlink($this->request->data['Schedule']['file_absolute_path']);
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
			}
		}
		$this->set('scheduleTypes', $this->Schedule->scheduleTypes);
		$this->set('title_for_layout', 'Thêm tài liệu');
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Schedule->exists($id)) {
			throw new NotFoundException(__('Invalid resource'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Schedule->id = $id;
			$user = $this->UserAuth->getUser();
			$this->request->data['Schedule']['user_create'] = $user['User']['first_name'];
			$options = array('conditions' => array('Schedule.' . $this->Schedule->primaryKey => $id));
			$oldSchedule = $this->Schedule->find('first', $options);
			if (is_file($oldSchedule['Schedule']['file_absolute_path'])) {
				unlink($oldSchedule['Schedule']['file_absolute_path']);
			}
			if ($this->Schedule->save($this->request->data)) {
				$this->Session->setFlash('Lưu thành công tài liệu', 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
			}
		}
		$options = array('conditions' => array('Schedule.' . $this->Schedule->primaryKey => $id));
		$this->request->data = $this->Schedule->find('first', $options);
		$this->set('scheduleTypes', $this->Schedule->scheduleTypes);
		$this->set('title_for_layout', 'Thêm tài liệu');
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Schedule->id = $id;
		if (!$this->Schedule->exists()) {
			throw new NotFoundException(__('Invalid resource'));
		}
		$this->request->onlyAllow('post', 'delete');
		$schedule = $this->Schedule->read(null, $id);
		if ($this->Schedule->delete()) {
			if (is_file($schedule['Schedule']['file_absolute_path'])) {
				unlink($schedule['Schedule']['file_absolute_path']);
			}
			$this->Session->setFlash('Đã xóa tài liệu ' . $schedule['Schedule']['title'], 'flash_success');
		} else {
			$this->Session->setFlash('Đã có lỗi xảy ra, vui lòng thử lại', 'flash_error');
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * Upload file
	 * 
	 * @return json result of uploading
	 */
	public function admin_upload() {
		Configure::load('my_configs');
		$this->layout = null;
		$this->autoRender = false;
		$baseUrl = Configure::read('base.url');
		$this->layout = null;
		$this->autoRender = false;
		$path = WWW_ROOT . 'schedules';
		if (!is_dir($path)) {
			mkdir($path);
		}
		$result = array();
		$result['status'] = 0;
		if (!empty($this->request->data)) {
			$this->Schedule->set($this->request->data);
			if ($this->Schedule->validates(array('fieldList' => array('file')))) {
				$fileName = $this->request->data['Schedule']['file']['name'];
				$fileName = time() . '_' . ($fileName);
				move_uploaded_file($this->request->data['Schedule']['file']['tmp_name'], $path . DS . $fileName);
				$extArr = explode('.', $fileName);
				$ext = array_pop($extArr);
				$result['ext'] = $ext;
				$result['icon'] = Router::url('/', true) . 'img/admin/icons/' . $this->Schedule->file_icons[$ext];
				$result['status'] = 1;
				$result['file_name'] = $fileName;
				$result['message'] = 'Upload tài liệu thành công';
				$result['file_path'] = $baseUrl . 'schedules/' . $fileName;
				$result['file_absolute_path'] = $path . DS . $fileName;
				$result['file_size'] = ($this->request->data['Schedule']['file']['size'] / 1000000) . ' MB';
			} else {
				// didn't validate logic
				$errors = $this->Schedule->validationErrors;
				$result['message'] = $errors['file']['0'];
			}
		} else {
			$result['message'] = 'File quá lớn hoặc định tên file không hợp lệ, vui lòng kiểm tra lại';
		}


		return json_encode($result);
	}

	public function admin_removeUploaded() {
		$path = $this->request->data['path'];
		$this->layout = false;
		$this->autoLayout = false;
		$this->autoRender = false;
		if (!empty($path))
			unlink($path);
		return json_encode(array('status' => 1));
	}

	public function listSchedules($id) {
		if ($this->request->isAjax) {
			$this->layout = null;
		} else {
			$this->layout = 'frontend/detailArticle';
		}
		$this->paginate = array('limit' => $this->limit, 'conditions' => array('Schedule.type' => $id));
		$this->set('schedules', $this->Paginator->paginate());
		$this->set('schedule_types', $this->Schedule->scheduleTypes[$id]);
		$this->set('title_for_layout', 'Điều hành tác nghiệp');
	}

	public function getScheduleTypes() {
		return $this->Schedule->scheduleTypes;
	}

	public function view($id) {
		$this->layout = 'frontend/detailArticle';
		$this->set('title_for_layout', 'Điều hành tác nghiệp');
		$schedule = $this->Schedule->read(null, $id);
		$this->set('schedule', $schedule);
	}

}
