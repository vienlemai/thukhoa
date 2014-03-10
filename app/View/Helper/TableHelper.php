<?php

/**
 * This helper will generate a table for index page
 *
 * @author Vienlemai
 */
class TableHelper extends AppHelper {

	public $helpers = array('Html', 'Paginator', 'Form');
	private $_controller;
	private $_action;
	private $_page;
	private $_limit;
	private $_options = array(
		'ordering_column' => true,
		'actions_column' => true,
		'sort_column' => false,
		'paging' => true,
		'table_class' => 'index-table',
		'active_action' => true,
		'edit_action' => true,
		'delete_action' => true,
		//paging options
		'page' => 1,
		'limit' => 1,
		'pp_first' => '<<Trang đầu',
		'pp_prev' => 'Trước',
		'pp_next' => 'Tiếp',
		'pp_last' => 'Trang cuối>>',
		'pp_number_class' => 'number',
		//title options
		'tt_ordering' => 'Thứ tự',
		'tt_actions' => 'Thao tác',
		'tt_sort' => 'Sắp xếp',
		'link_to_view' => false,
		'align_left' => false,
	);
	private $_colums = array();

	private function _init($options) {
		$this->_controller = $this->request->params['controller'];
		$this->_action = $this->request->params['action'];
		//init page and limit for paging
		$arrPage = $this->Paginator->params();
		$this->_page = $arrPage['page'];
		$this->_limit = $arrPage['limit'];
		//init options
		$this->_options = array_merge($this->_options, $options);
		//debug($this->_options);
	}

	private function _initColumns($columns) {
		$index = 0;
		foreach ($columns as $k => $v) {
			$indexs = explode('.', $k);
			$this->_colums[$index]['Model'] = $indexs[0];
			$this->_colums[$index]['column'] = $indexs[1];
			$index++;
		}
	}

	private function _generateHeader($columns) {
		$header = '<thead>';
		if ($this->_options['ordering_column'])
			$header.= '<th width="8%">' . $this->_options['tt_ordering'] . '</th>';
		foreach ($columns as $k => $v) {
			$header.= '<th>' . $v . '</th>';
		}
		if ($this->_options['sort_column']) {
			$header.= '<th>' . $this->_options['tt_sort'];
			$header.= $this->Html->link('Lưu sắp xếp', '#');
			$header.= '</th>';
		}
		//debug($this->_options['actions_column']);
		if ($this->_options['actions_column'])
			$header.= '<th>' . $this->_options['tt_actions'] . '</th>';
		$header.= '</thead>';
		return $header;
	}

	public function render($data_provider, $columns, $options = array()) {
		$this->_init($options);
		$this->_initColumns($columns);
		$output = '<table class = "table-data table table-striped table-bordered dataTable">';
		$output.= $this->_generateHeader($columns);
		$index = ($this->_page - 1) * $this->_limit;
		foreach ($data_provider as $data) {
			// debug($data['Category']);
			$output.= '<tr>';
			$output.= '<td>' . ++$index . '</td>';
			foreach ($this->_colums as $column) {
				//check if current column has to align left
				if ($this->_options['align_left'] == $column['column']) {
					$output.= '<td style="text-align: left">';
				} else {
					$output.= '<td>';
				}
				
				if ($column['column'] == 'is_active') {
					if ($data[$column['Model']]['is_active'] == 1) {
						//url for active : app/active/controller/model/id/status/page :(it's a litle long but helpful
						$output.= $this->Html->link(
								$this->Html->image('admin/approve.png'), array('controller' => 'app', 'action' => 'active', $this->_controller, $column['Model'], $data[$column['Model']]['id'], 0, $this->_page), array('escape' => false));
					} else {
						$output.= $this->Html->link(
								$this->Html->image('admin/dis-approve.png'), array('controller' => 'app', 'action' => 'active', $this->_controller, $column['Model'], $data[$column['Model']]['id'], 1, $this->_page), array('escape' => false));
					}
				}
				else if($column['column'] == 'created'){
					$output.= date('d/m/Y',  strtotime($data[$column['Model']][$column['column']]));
				}
				else {
					if ($this->_options['link_to_view'] == $column['column']) {
						$output.= $this->Html->link($data[$column['Model']][$column['column']], array('controller' => $this->_controller, 'action' => 'view', $data[$column['Model']]['id']));
					} else {
						if (!empty($data[$column['Model']][$column['column']]))
							$output.= $data[$column['Model']][$column['column']];
						else
							$output.= '';
					}
				}
				$output.= '</td>';
			}
			if ($this->_options['sort_column']) {
				$output.= '<td>';
				$output.= 'Sắp xếp';
				$output.= '</td>';
			}

			if ($this->_options['actions_column']) {
				$output.= '<td>';
				if ($this->_options['edit_action']) {
					$output.= $this->Html->link(
							$this->Html->image('admin/edit.png'), array('controller' => $this->_controller, 'action' => 'edit', $data[$column['Model']]['id']), array('escape' => false)
					);
				}
				if ($this->_options['delete_action']) {
					$output.= $this->Form->postLink(
							$this->Html->image('admin/delete.png'), array('controller' => $this->_controller, 'action' => 'delete', $data[$column['Model']]['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ?'
					);
				}
				$output.= '</td>';
			}

			$output.= '</tr>';
		}
		$output.= '</table>';
		$output.= $this->_generatePaging();

		//debug($this->_initPaging());exit();

		return $output;
	}

	private function _generatePaging() {
		$output = "";
		if ($this->_options['paging']) {
			$output.= "<div class='pagination'>";
			$output.= $this->Paginator->first($this->_options['pp_first']);
			$output.= $this->Paginator->prev($this->_options['pp_prev']);
			$output.= $this->Paginator->numbers(array('separator' => false, 'class' => $this->_options['pp_number_class']));
			$output.= $this->Paginator->next($this->_options['pp_next']);
			$output.= $this->Paginator->last($this->_options['pp_last']);
			$output.= '</div>';
		}
		return $output;
	}

}

?>
