<?php

App::uses('AppModel', 'Model');

/**
 * Video Model
 *
 */
class Link extends AppModel {
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'title';
	public $linkTypes = array(
		1 => 'Website giáo dục',
		2 => 'Liên kết khác',
	);
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Nhập tên trang web liên kết',
			),
		),
		'link' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Nhập link trang web liên kết',
			),
		)
	);

}
