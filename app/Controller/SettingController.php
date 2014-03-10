<?php

App::uses('AppController', 'Controller');

class SettingController extends AppController {
	public $layout = 'admin/admin';

	// Chuyển qua controller mới, ko dùng action trong Admin Controller nữa
	public function admin_view() {
		$this->loadModel('Subject');
		$this->loadModel('Year');
		$this->set('subjects', $this->Subject->find('all'));
		$this->set('years', $this->Year->find('all'));
		$this->loadModel('Page');
	}

}

?>
