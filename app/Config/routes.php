<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('controller' => 'index', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
Router::connect(
		'/chi-tiet-bai-viet/:id-:slug', array('controller' => 'posts', 'action' => 'view'), array('pass' => array('id', 'slug'), 'id' => '[0-9]+')
);

Router::connect(
		'/bai-viet/:id-:slug', array('controller' => 'posts', 'action' => 'posts'), array('pass' => array('id', 'slug'), 'id' => '[0-9]+')
);

// Routes for pages controller
// Route for view all post in a category
Router::connect(
		'/bai-viet/:category_name/:post_id-:slug', array('controller' => 'categories', 'action' => 'view'), array(
	'pass' => array('category_name', 'post_id', 'slug'),
	'post_id' => '[0-9]+'
		)
);


// Routes for blogs
Router::connect('/blog-giao-vien', array('controller' => 'blogs', 'action' => 'index'));

Router::connect(
		'/blog/:bloger_id-:slug', array(
	'controller' => 'blogs',
	'action' => 'index'
		), array(
	'pass' => array('bloger_id', 'slug'), 'bloger_id' => '[0-9]+')
);
Router::connect(
		'/blog/:bloger_id-:slug/bai-viet/:article_id-:article_title', array('controller' => 'blogs', 'action' => 'viewArticle'), array(
	'pass' => array('bloger_id', 'slug', 'article_id'), 'bloger_id' => '[0-9]+', 'article_id' => '[0-9]+')
);
Router::connect(
		'/blog/:bloger_id-:slug/sua-bai-viet/:article_id', array('controller' => 'blogs', 'action' => 'editArticle'), array(
	'pass' => array('bloger_id', 'slug', 'article_id'), 'bloger_id' => '[0-9]+', 'article_id' => '[0-9]+')
);
Router::connect(
		'/blog/:bloger_id-:slug/bai-viet', array('controller' => 'blogs', 'action' => 'writeArticle'), array(
	'pass' => array('bloger_id', 'slug'), 'bloger_id' => '[0-9]+')
);

Router::connect(
		'/blog/xoa_bai', array('controller' => 'blogs', 'action' => 'deleteArticle', '[method]' => 'POST')
);
// End Routes for blogs
/**
 * Frontend video
 */
Router::connect('/videos', array('controller' => 'videos', 'action' => 'index'));
Router::connect(
		'/xem-video/:id-:slug', array(
	'controller' => 'videos',
	'action' => 'view'
		), array(
	'pass' => array('id', 'slug'), 'id' => '[0-9]+')
);
/**
 * Frontend album anh
 */
Router::connect('/album-anh', array('controller' => 'albums', 'action' => 'index'));
Router::connect('/lien-he', array('controller' => 'pages', 'action' => 'contact'));
/**
 * Frontend resource
 */
Router::connect(
		'/xem-tai-lieu/:id-:slug', array(
	'controller' => 'resources',
	'action' => 'view'
		), array(
	'pass' => array('id', 'slug'), 'id' => '[0-9]+')
);
Router::connect(
		'/tai-lieu/:id', array(
	'controller' => 'resources',
	'action' => 'listResources'
		), array(
	'pass' => array('id'), 'id' => '[0-9]+')
);


/**
 * Frontend Schedule
 */
Router::connect(
		'/lich-lam-viec/:id', array(
	'controller' => 'schedules',
	'action' => 'listSchedules'
		), array(
	'pass' => array('id'), 'id' => '[0-9]+')
);
Router::connect(
		'/xem-thoi-khoa-bieu/:id-:slug', array(
	'controller' => 'schedules',
	'action' => 'view'
		), array(
	'pass' => array('id'), 'id' => '[0-9]+')
);
/**
 * Frontend Blog
 */
Router::connect('/blog/filter_article_by_date', array(
	'controller' => 'blogs',
	'action' => 'filterArticleByDate'
		)
);
//Router::connect('/blog/:bloger_id/login', array('controller' => ''));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require 'admin_routes.php';
require CAKE . 'Config' . DS . 'routes.php';
