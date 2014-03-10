<?php

App::uses('AppModel', 'Model');

/**
 * Photo Model
 *
 * @property Album $Album
 */
class Photo extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'title';

//The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Album' => array(
            'className' => 'Album',
            'foreignKey' => 'album_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function beforeDelete($cascade = true) {
        parent::beforeDelete($cascade);
        // Xóa file ảnh sau khi xóa record. Có thể phát sinh lỗi bởi ko đủ quyền.
//        $path = WWW_ROOT . 'img/albums' . DS . $this->data['Photo']['album_id'] . DS . $this->data['Photo']['url'];
//        chown($path, 0777);
//        try {
//            unlink($path);
//        } catch (Exception $exc) {
//            return false;
//        }
//        return true;
    }

}

