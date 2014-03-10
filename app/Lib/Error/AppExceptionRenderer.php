<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('ExceptionRenderer', 'Error');

class AppExceptionRenderer extends ExceptionRenderer {

    public function notFound($error) {
        $this->controller->redirect(array('controller' => 'errors', 'action' => 'error404'));
    }

}

?>
