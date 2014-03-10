<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ErrorsController extends AppController {

    public $name = 'Errors';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('error404','error400');
    }

    public function error400() {
        $this->layout = 'frontend/index';
    }

}

?>
