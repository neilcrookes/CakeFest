<?php
class Category extends AppModel {

	var $name = 'Category';

	var $validate = array(
		'parent_id' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The parent must be numeric',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'lft' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The lft must be numeric',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'rght' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The rght must be numeric',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a name',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
		'slug' => array(
			'regex0' => array(
				'rule' => '/^[a-z0-9\_\-]*$/i',
				'message' => 'Please enter a valid slug',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
		'direct_child_count' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The direct child count must be numeric',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'child_count' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The child count must be numeric',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'post_count' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The post count must be numeric',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'active' => array(
			'boolean' => array(
				'rule' => 'boolean',
				'message' => 'The active must be boolean',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
	);



	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'category_id',
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
?>