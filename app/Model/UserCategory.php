<?php

App::uses('AppModel', 'Model');

/**
 * Category Model
 *
 * @property Category $ParentCategory
 * @property Category $ChildCategory
 * @property Post $Post
 */
class UserCategory extends AppModel {
	public $displayField = 'id';
}
