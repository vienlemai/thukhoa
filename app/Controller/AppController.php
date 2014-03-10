<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $helpers = array('Form', 'Html', 'Session', 'Js', 'Table', 'TvFck', 'Menu', 'Facebook.Facebook');
	public $components = array('Session', 'RequestHandler', 'Usermgmt.UserAuth', 'Common');
	protected $limit = 10;

	function beforeFilter() {
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			$this->userAuth();
		} else {
			$current_menu_id = 0;
			$this->set('current_menu_id', $current_menu_id);
			$this->loadModel('Subject');
			$this->loadModel('Year');
			$this->loadModel('Menu');
			$menus = $this->Menu->find('all', array('conditions' => array('Menu.parent_id' => null),'Menu.is_active'=>true));
			$this->set('menus', $menus);
			$this->set('subjects', $this->Subject->find('all', array(
						'fields' => array('Subject.name', 'Subject.id'),
						'conditions' => array('Subject.is_active' => true),
			)));
			$this->set('years', $this->Year->find('all', array(
						'fields' => array('Year.name', 'Year.id'),
						'conditions' => array('Year.is_active' => true),
			)));
		}
	}

	private function userAuth() {
		$this->UserAuth->beforeFilter($this);
	}

	public function admin_active($controller, $model, $id, $status, $page = 1) {
		$this->loadModel($model);
		$this->$model->id = $id;
		$this->$model->saveField('is_active', $status);
		if ($page == 1)
			$this->redirect(array('controller' => $controller, 'action' => 'index'));
		else
			$this->redirect(array('controller' => $controller, 'action' => 'index', 'page' => $page));
	}

}
