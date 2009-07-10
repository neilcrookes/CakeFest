<?php
class Comment extends AppModel {

	var $name = 'Comment';

	var $validate = array(
		'post_id' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The post must be numeric',
				'required' => false,
				'allowEmpty' => false,
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
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'The email must be email',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'website' => array(
			'url' => array(
				'rule' => 'url',
				'message' => 'The website must be url',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
		'comment' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a comment',
				'required' => false,
				'allowEmpty' => false,
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
	var $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>