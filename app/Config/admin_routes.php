<?php

/**
 * Routers for backend
 */
Router::connect('/admin', array('controller' => 'admin', 'action' => 'index', 'admin' => true));
Router::connect('/dashboard', array('controller' => 'admin', 'action' => 'index', 'admin' => true));
Router::connect('/admin/danh-muc', array('controller' => 'categories', 'action' => 'index', 'admin' => true));
Router::connect('/admin/them-danh-muc', array('controller' => 'categories', 'action' => 'add', 'admin' => true));
Router::connect('/admin/danh-sach-bai-viet', array('controller' => 'posts', 'action' => 'index', 'admin' => true));
Router::connect('/admin/danh-sach-bai-viet/page:id', array(
    'controller' => 'posts',
    'action' => 'index',
    'admin' => true), array('pass' => array('id'))
);
Router::connect('/admin/them-bai-viet', array('controller' => 'posts', 'action' => 'add', 'admin' => true));
Router::connect('/admin/videos', array('controller' => 'videos', 'action' => 'index', 'admin' => true));
Router::connect('/admin/them-video', array('controller' => 'videos', 'action' => 'add', 'admin' => true));
Router::connect('/admin/album-anh', array('controller' => 'albums', 'action' => 'index', 'admin' => true));
Router::connect('/admin/album-anh/upload', array('controller' => 'albums', 'action' => 'upload', 'admin' => true));
Router::connect('/admin/them-tai-lieu', array('controller' => 'resources', 'action' => 'add', 'admin' => true));
Router::connect('/admin/tai-lieu', array('controller' => 'resources', 'action' => 'index', 'admin' => true));
Router::connect('/admin/menu', array('controller' => 'menus', 'action' => 'index', 'admin' => true));
Router::connect('/admin/them-menu', array('controller' => 'menus', 'action' => 'add', 'admin' => true));

Router::connect('/admin/album-anh/delete_photo', array('controller' => 'albums', 'action' => 'deletePhoto', 'admin' => true));
Router::connect('/admin/albums/tao-slide-album', array('controller' => 'albums', 'action' => 'createSlideAlbum', 'admin' => true));

Router::connect('/admin/cau-hinh-site',array('controller' => 'setting', 'action' => 'view', 'admin' => true));
Router::connect('/admin/trang-lien-he',array('controller' => 'pages', 'action' => 'contactPage', 'admin' => true));