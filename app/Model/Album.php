<?php

App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility'); // for upload image
/**
 * Album Model
 *
 */

class Album extends AppModel {
    /**
     * Use table
     *
     * @var mixed False or table name
     */

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
    public $hasMany = array(
        'Photo' => array(
            'className' => 'Photo',
            'foreignKey' => 'album_id',
        )
    );
    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Không được để trống tiêu đề',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'created_at' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        $this->data[$this->name]['created_at'] = date('Y-m-d H:i:s');
    }

    public function existsSlideAlbum() {
        $options = array(
            'conditions' => array(
                'Album.for_slide' => 1
            ),
             'recursive' => -1
        );
        $slide_album = $this->find('first', $options);
        return empty($slide_album) ? false : true;
    }

    public function findSlideAlbum() {
        $options = array(
            'conditions' => array(
                'Album.for_slide' => 1
            )
        );
        $album = $this->find('first', $options);
        $photo_urls = array();
        if (!empty($album)) {
            foreach ($album['Photo'] as $photo) {
                $relative_path = 'albums/' . $album['Album']['id'] . '/' . $photo['url'];
                array_push($photo_urls, $relative_path);
            }
        } else { // Lấy trong thư mục mặc định nếu như ko tìm thấy slide album
            $slide_photos_path = WWW_ROOT . 'img/slide_photos' . DS;
            // Scan file ảnh, chấp nhận định dạng [jpg, jpeg, png]
            $photo_files = preg_grep('~\.(jpeg|jpg|png)$~', scandir($slide_photos_path));
            foreach ($photo_files as $photo_file) {
                $relative_path = 'slide_photos/' . $photo_file;
                array_push($photo_urls, $relative_path);
            }
        }
        return $photo_urls;
    }

    public function createSlideAlbum() {
        // Thư mục mặc định là : 'webroot/img/slide_photos'
        $slide_photos_path = WWW_ROOT . 'img/slide_photos' . DS;
        // Scan file ảnh, chấp nhận định dạng [jpg, jpeg, png]
        $photo_files = preg_grep('~\.(jpeg|jpg|png)$~', scandir($slide_photos_path));

        // Tạo Album
        $this->data[$this->name] = array(
            'name' => 'Ảnh cho slide',
            'description' => 'Album này sẽ được hiển thị ở trang chủ. Mặc định sẽ lấy các ảnh trong thư mục \'slide_photos\' khi khởi tạo. Chú ý: kích thước ảnh nên là 800x300.',
            'for_slide' => 1
        );
        $slide_album = $this->save();

        // Tạo thư mục cho album
        $folder = new Folder();
        $album_path = WWW_ROOT . 'img/albums' . DS . $slide_album[$this->name]['id'];
        $folder->create($album_path);

        // Lưu các ảnh trong slide
        $Photo = ClassRegistry::init('Photo');

        foreach ($photo_files as $photo_file) {
            // Copy file từ thư mục slide_photos sang thư mục của album và tạo record.
            copy($slide_photos_path . $photo_file, $album_path . DS . $photo_file);
            $photo_data['Photo'] = array(
                'album_id' => $slide_album[$this->name]['id'],
                'url' => $photo_file
            );
            $Photo->create();
            $Photo->save($photo_data);
        }
        // !
        return true;
    }

}
