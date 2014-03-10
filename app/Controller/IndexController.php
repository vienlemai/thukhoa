<?php

App::uses('AppController', 'Controller');

class IndexController extends AppController {
	public $layout = 'frontend/index';
	public $components = array('Paginator');
	public $uses = array('Usermgmt.User', 'Articlesss');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$title_for_layout = "Trang chủ";
		get_class($this->User);
		# For teacher blogs table
		$teachers = $this->User->find('all', array('conditions' => array('User.user_group_id' => 2)));
		$this->set(compact('teachers', 'title_for_layout'));
	}

}

?>
