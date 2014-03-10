<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AdminController extends AppController {
	public $layout = 'admin/admin';

	public function admin_index() {
		$isAdmin = $this->UserAuth->isAdmin();
		$this->set('isAdmin', $isAdmin);
		$this->loadModel('UserModule');
		$modules = $this->UserModule->modules;
		$userId = $this->UserAuth->getUserId();
		if (!$this->UserAuth->isAdmin()) {
			$modulesAllowIds = $this->UserModule->find('all', array('fields' => array('UserModule.module_id'), 'conditions' => array('UserModule.user_id' => $userId)));
			//var_dump($modulesAllowIds);exit();
			$modulesTmp = array();
			foreach ($modulesAllowIds as $module) {
				array_push($modulesTmp, $modules[$module['UserModule']['module_id']]);
			}
			$modules = $modulesTmp;
		}
		$this->set('modules', $modules);
		$this->set('title_for_layout', 'Quản trị nội dung');
	}

	public function admin_config() {
		$this->loadModel('Subject');
		$this->set('links', $this->Link->find('all'));
		$this->set('subjects', $this->Subject->find('all'));
	}

	public function admin_getBackendMenu() {
		$this->loadModel('UserModule');
		$modules = $this->UserModule->modules;
		$userId = $this->UserAuth->getUserId();
		if (!$this->UserAuth->isAdmin()) {
			$modulesAllowIds = $this->UserModule->find('all', array('fields' => array('UserModule.module_id'), 'conditions' => array('UserModule.user_id' => $userId)));
			//var_dump($modulesAllowIds);exit();
			$modulesTmp = array();
			foreach ($modulesAllowIds as $module) {
				array_push($modulesTmp, $modules[$module['UserModule']['module_id']]);
			}
			$modules = $modulesTmp;
		}
		return $modules;
	}

}
