<?php
class Post extends AppModel {

	var $name = 'Post';

	var $validate = array(
		'category_id' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The category must be numeric',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a title',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
			'maxLength' => array(
				'rule' => array('maxLength', 150, ),
				'message' => 'The title must be max length 150',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
		'slug' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a slug',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
			'regex0' => array(
				'rule' => '/^[a-z0-9\_\-]*$/i',
				'message' => 'Please enter a valid slug',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
		'comment_count' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The comment count must be numeric',
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
		'published' => array(
			'regex0' => array(
				'rule' => '/^\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}$/i',
				'message' => 'Please enter a valid published date',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
	);



	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'post_id',
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

	var $hasAndBelongsToMany = array(
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'posts_tags',
			'foreignKey' => 'post_id',
			'associationForeignKey' => 'tag_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>