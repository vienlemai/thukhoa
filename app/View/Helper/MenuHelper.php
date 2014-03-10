<?php

/**
 * MenuHelper
 *
 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
 * @link http://www.infinitas-cms.org
 * @package Infinitas.Menus.Helper
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.8a
 *
 * @author Carl Sutton <dogmatic69@infinitas-cms.org>
 */
App::uses('InfinitasHelper', 'Libs.View/Helper');

/**
 * MenuHelper
 *
 * Menu helper is used for generating different types of menus. From the
 * dashboard icons found in the admin backend to nested lists for the
 * frontend.
 *
 * @package Infinitas.Menus.Helper
 */
class MenuHelper extends AppHelper {
	public $menuHtml = '';
	var $helpers = array('Html');

	/**
	 * create the items in the list.
	 *
	 * @param array $array part of the tree
	 * @param string $model the alias of the model being used
	 *
	 * @return array
	 */
	
	
	public function buildDropdownMenu($menu) {
		//debug($menu['Category']);
		//exit();
		if (empty($menu['children'])) {
			$item = '<li>';
			$item.= $this->Html->link($menu['Category']['name'], array('controller'=>'posts','action'=>'posts','id'=>$menu['Category']['id'],'slug'=>$menu['Category']['alias']));
			$item .= '</li>';
			return $item;
		} else {
			$item = '';
			if ($menu['Category']['parent_id'] == null) {
				$item.='<li class="dropdown">';
				$item.= $this->Html->link($menu['Category']['name'] . '<b class="caret"></b>', '#', array('tabindex' => '-1', 'escape' => false));
				//$item.=;
			} else {
				$item.='<li class="dropdown-submenu">';
				$item.= $this->Html->link($menu['Category']['name'], array('controller'=>'posts','action'=>'posts','id'=>$menu['Category']['id'],'slug'=>$menu['Category']['alias']), array('tabindex' => '-1'));
			}
			$item.='<ul class="dropdown-menu">';
			foreach ($menu['children'] as $chilren) {
				$item.= $this->buildDropdownMenu($chilren);
			}
			$item.='</ul>';
			$item .= '</li>';
			return $item;
		}
	}

	public function generateTree($root) {
		if (empty($root['children'])) {
			$item = '<li>';
			$item.= '<label><input type="checkbox" name="data[Category][]" value="' . $root['Category']['id'] . '">' . $root['Category']['name'] . '</label>';
			$item .= '</li>';
			return $item;
		} else {
			$item = '<li>';
			$item.= '<label><input type="checkbox" name="data[Category][]" value="' . $root['Category']['id'] . '">' . $root['Category']['name'] . '</label>';
			$item.= '<ul>';
			foreach ($root['children'] as $child) {
				$item.= $this->generateTree($child);
			}
			$item.= '</ul>';
			$item .= '</li>';
			return $item;
		}
	}

	public function generateTreeAllow($root, $allow) {
		if (empty($root['children'])) {
			$item = '<li>';
			if (in_array($root['Category']['id'], $allow)) {
				$item.= '<label><input type="checkbox" name="data[Category][]" value="' . $root['Category']['id'] . '" checked>' . $root['Category']['name'] . '</label>';
			} else {
				$item.= '<label><input type="checkbox" name="data[Category][]" value="' . $root['Category']['id'] . '">' . $root['Category']['name'] . '</label>';
			}
			$item .= '</li>';
			return $item;
		} else {
			$item = '<li>';
			if (in_array($root['Category']['id'], $allow)) {
				$item.= '<label><input type="checkbox" name="data[Category][]" value="' . $root['Category']['id'] . '" checked>' . $root['Category']['name'] . '</label>';
			} else {
				$item.= '<label><input type="checkbox" name="data[Category][]" value="' . $root['Category']['id'] . '">' . $root['Category']['name'] . '</label>';
			}
			$item.= '<ul>';
			foreach ($root['children'] as $child) {
				$item.= $this->generateTreeAllow($child,$allow);
			}
			$item.= '</ul>';
			$item .= '</li>';
			return $item;
		}
	}

}
