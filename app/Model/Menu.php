<?php

App::uses('AppModel', 'Model');

/**
 * Menu Model
 *
 * @property Menu $ParentMenu
 * @property Menu $ChildMenu
 */
class Menu extends AppModel {
	//public $actsAs = array('Tree');
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $MENU_CATEGORY = 1;
	public static $MENU_POST = 2;
	public static $MENU_ALBUM = 3;
	public static $MENU_VIDEO = 4;
	public static $MENU_CUSTOM = 5;
	public $menu_titles = array(
		1 => 'Danh mục',
		2 => 'Bài viết',
		3 => 'Album ảnh',
		4 => 'Video',
		5 => 'Đường dẫn tự nhập',
	);
	public $menu_types = array(
		1 => array(
			'title' => 'Danh mục',
			'controller' => 'posts',
			'action' => 'posts',
			'menu_action' => 'listcategories',
			'input_link'=>0,
		),
		2 => array(
			'title' => 'Bài viết',
			'controller' => 'posts',
			'action' => 'view',
			'menu_action' => 'listposts',
			'input_link'=>0,
		),
		3 => array(
			'title' => 'Album ảnh',
			'controller' => 'albums',
			'action' => 'index',
			'menu_action' => '',
			'input_link'=>0,
		),
		4 => array(
			'title' => 'Video',
			'controller' => 'videos',
			'action' => 'index',
			'menu_action' => '',
			'input_link'=>0,
		),
		5 => array(
			'title' => 'Đường dẫn tự nhập',
			'controller' => '',
			'action' => '',
			'menu_action' => '',
			'input_link'=>1,
		),
	);
	public $validate = array(
//		'alias' => array(
//			'notempty' => array(
//				'rule' => array('notempty'),
//			//'message' => 'Your custom message here',
//			//'allowEmpty' => false,
//			//'required' => false,
//			//'last' => false, // Stop validation after this rule
//			//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bạn chưa nhập tên menu',
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'menu_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bạn chưa chọn nội dung cho menu',
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bạn chưa chọn nội dung cho menu',
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'ParentMenu' => array(
			'className' => 'Menu',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'ChildMenu' => array(
			'className' => 'Menu',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
