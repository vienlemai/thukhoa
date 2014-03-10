<?php

App::uses('AppModel', 'Model');

/**
 * Video Model
 *
 */
class Subject extends AppModel {
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Tên môn học không được rỗng',
			),
		),
	);

}
