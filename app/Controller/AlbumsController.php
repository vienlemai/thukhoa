<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility'); // for upload image
/**
 * Albums Controller
 *
 * @property Album $Album
 * @property PaginatorComponent $Paginator
 */

class AlbumsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
//    public $layout = 'admin/admin';
    public $uses = array('Album', 'Photo');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->layout = 'frontend/detailArticle';
        $this->Album->recursive = 1;
//        $current_menu_id = 
        $this->set('albums', $this->Album->find('all',array('order'=>'Album.created_at DESC')));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Album->exists($id)) {
            throw new NotFoundException(__('Invalid album'));
        }
        $options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
        $this->set('album', $this->Album->find('first', $options));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->layout = 'admin/admin';
        $this->Album->recursive = 1;
        $albums = $this->Album->find('all',array('order'=>'Album.created_at DESC'));
        $existsSlideAlbum = $this->Album->existsSlideAlbum();
        $this->set(compact('albums', 'existsSlideAlbum'));
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        $this->layout = 'admin/admin';
        if (!$this->Album->exists($id)) {
            throw new NotFoundException(__('Invalid album'));
        }
        $options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
        //$this->log($this->Album->find('first', $options), 'debug');
        $this->set('album', $this->Album->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        $this->layout = 'admin/admin';
        if ($this->request->is('post')) {
            $this->Album->create();
            if ($this->Album->save($this->request->data)) {
                $this->Session->setFlash('Tạo Album thành công', 'flash_success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Không thể tạo Album mới', 'flash_error');
            }
        }
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->layout = 'admin/admin';
        if (!$this->Album->exists($id)) {
            throw new NotFoundException(__('Invalid album'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Album->save($this->request->data)) {
                $this->Session->setFlash('Cập nhật Album thành công', 'flash_success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Cập nhật Album thất bại', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
            $this->request->data = $this->Album->find('first', $options);
        }
    }

    public function admin_upload() {
        $this->autoRender = false;
        //$this->log($this->request->data, 'debug');
		//var_dump($this->request->data['album_id']); exit();
        $album_id = $this->request->data['album_id'];
        $photo_temps = $this->request->data['Photos'];
        //Create folder to upload
        $folder = new Folder();
        $path = WWW_ROOT . 'img/albums' . DS . $album_id;
        $folder->create($path);
        foreach ($photo_temps as $tmp) {
            if (empty($tmp['tmp_name'])) {
                continue;
            }
            $photo = array();
            $photo['Photo']['album_id'] = $album_id;
            $photo['Photo']['url'] = $tmp['name'];
            move_uploaded_file($tmp['tmp_name'], $path . DS . $tmp['name']);
            $this->Photo->create();
            $this->Photo->save($photo);
        }
        $this->redirect(Router::url('/admin/albums/view/' . $album_id));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Album->id = $id;
        if (!$this->Album->exists()) {
            throw new NotFoundException(__('Invalid album'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Album->delete()) {
           $photos =  $this->Photo->find('all', array(
               'conditions' => array(
                   'Photo.album_id' => $id
               ),
               'recursive' => -1,
               'fields' => array('id')
           ));
           foreach ($photos as $photo) {
               $this->Photo->delete($photo['Photo']['id']);
           }
            
            $this->Session->setFlash('Đã xóa một Album', 'flash_success');
        } else {
            $this->Session->setFlash('Xóa Album không thành công', 'flash_eror');
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_deletePhoto() {
        $this->autoRender = false;
        $this->response->type('json');
        $resp = array();
        $resp['success'] = false;
        $photo_id = $this->request->data['photo_id'];
        $album_id = $this->request->data['album_id'];
        $photo_will_del = $this->Photo->read(null, $photo_id);
        if ($photo_will_del['Photo']['album_id'] == $album_id) {
            if ($this->Photo->delete($photo_id)) {
                $resp['success'] = true;
            }
        }
        $this->response->body(json_encode($resp));
    }

    public function recentAlbum() {
        $album = $this->Album->find('first',array('Album.for_slide != '=>1));
        return $album;
    }

    // Tạo album cho slide
    public function admin_createSlideAlbum() {
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->autoLayout = false;
            $this->response->type('json');
            $this->Album->createSlideAlbum();
            $this->response->body(json_encode(array('success' => true)));
        } else {
            
        }
    }

    // Lấy path các ảnh trong slide album
    public function photosSlide() {
        return $this->Album->findSlideAlbum();
    }

}
