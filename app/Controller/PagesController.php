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
class PagesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     * @throws NotFoundException When the view file could not be found
     * 	or MissingViewException in debug mode.
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    // Hiển thị trang liên hệ
    public function contact() {
        $this->layout = 'frontend/detailArticle';
        $contact_page = $this->Page->findOrCreateContactPage();
        $this->set(compact('contact_page'));
    }

    // Cho menu giới thiệu
//    public function getIntroductionMenu() {
//        $this->loadModel('Page');
//    }

    public function admin_manage() {
        $this->layout = 'admin/admin';
        $pages = $this->Page->find('all');
        $this->set(compact('pages'));
    }

    public function admin_contactPage() {
        $this->layout = 'admin/admin';
        if ($this->request->is('get')) {
            $this->request->data = $this->Page->findOrCreateContactPage();
        } else {
            if ($this->Page->save($this->request->data)) {
                $this->Session->setFlash(__('Lưu thành công.'));
                return $this->redirect(Router::url(array('controller' => 'pages', 'action' => 'contactPage', 'admin' => true)));
            } else {
                $this->Session->setFlash(__('Lưu không thành công.'));
            }
        }
    }

    public function admin_edit() {
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Page->save($this->request->data)) {
                $this->Session->setFlash(__('Lưu thành công.'));
                return $this->redirect(array('action' => 'manage'));
            } else {
                $this->Session->setFlash(__('Lưu không thành công.'));
            }
        } else {
            $this->layout = 'admin/admin';
            $page_name = $this->request->params['page_name'];
            $options = array('conditions' => array(
                    'Page.name' => $page_name
            ));
            $this->request->data = $this->Page->find('first', $options);
            $page = $this->Page->find('first', $options);
            $this->set(compact('page'));
        }
    }

}
