<?php
class Comment extends AppModel {

	var $name = 'Comment';
	var $validate = array(
		'post_id' => array('numeric'),
		'name' => array('notempty'),
		'email' => array('email'),
		'comment' => array('notempty'),
		'active' => array('boolean')
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