<?php

App::uses('AppModel', 'Model');

/**
 * Page Model
 *
 */
class Page extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
//            'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            'message' => 'Tiêu đề không được để trống',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'content' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            'message' => 'Nội dung không được để trống',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    public function findOrCreateContactPage() {
        $options = array('conditions' => array(
                'name' => 'lien-he'
        ));
        $contact_page = $this->find('first', $options);
        if (empty($contact_page)) {
            $data = array(
                $this->name => array(
                    'name' => 'lien-he',
                    'title' => 'Thông tin liên hệ',
                    'content' => 'Nội dung liên hệ.'
            ));
            $contact_page = $this->save($data);
        }
        return $contact_page;
    }

}
