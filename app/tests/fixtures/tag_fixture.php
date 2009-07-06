<?php 
/* SVN FILE: $Id$ */
/* Tag Fixture generated on: 2009-07-06 21:07:56 : 1246913636*/

class TagFixture extends CakeTestFixture {
	var $name = 'Tag';
	var $table = 'tags';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'tag' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'tag' => array('column' => 'tag', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'tag'  => 'Lorem ipsum dolor sit amet'
	));
}
?>