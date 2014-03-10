<?php

App::uses('AppModel', 'Model');

/**
 * Resource Model
 *
 */
class Confidential extends AppModel {
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'title';
	public $validate = array(
		'title' => array(
			'rule' => array('notempty'),
			'message' => 'Bạn chửa nhập tiêu đề',
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bạn chưa nhập email',
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'Địa chỉ email không hợp lệ',
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bạn chưa nhập nội dung',
			),
			'length' => array(
				'rule' => array('minLength', 100),
				'message' => 'Nội dung của bạn quá ngắn',
			),
		),
	);

}
