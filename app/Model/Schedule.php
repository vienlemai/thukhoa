<?php

App::uses('AppModel', 'Model');

/**
 * Resource Model
 *
 */
class Schedule extends AppModel {
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'title';
	public $scheduleTypes = array(
		1 => 'Thông tin, thông báo',
		2 => 'Lịch công tác tuần',
		3 => 'Lịch công tác tháng',
		4 => 'Thời khóa biểu',
		5 => 'Văn bản pháp quy',
		6 => 'Góp ý BGH',
	);
	public $file_icons = array(
		'pdf' => '_pdf.png',
		'doc' => '_doc.png',
		'docx' => '_docx.png',
		'xls' => '_excel.png',
		'xlsx' => '_excel.png',
		'ppt' => '_ppt.png',
	);
	public $resource_type = array(
		1 => 'Giáo án điện tử',
		2 => 'Sách điện tử',
		3 => 'Bộ đề kiểm tra',
	);
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Nhập tiêu đề tài liệu',
			),
		),
		'file' => array(
			'name' => array(
				'rule' => array('extension', array('pdf', 'doc', 'docx', 'xls', 'xlsx')),
				'message' => 'Chỉ cho phép các định dạng  pdf, doc, docx, xls , xlsx',
			),
			'tmp_name' => array(
				'rule' => array('fileSize', '<=', '10MB'),
				'message' => 'Chỉ được chọn file nhỏ hơn 10M'
			)
		),
	);

}
