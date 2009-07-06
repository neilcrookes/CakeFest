<?php 
/* SVN FILE: $Id$ */
/* Category Fixture generated on: 2009-07-06 21:07:40 : 1246913440*/

class CategoryFixture extends CakeTestFixture {
	var $name = 'Category';
	var $table = 'categories';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'lft' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'rght' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'slug' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'direct_child_count' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'child_count' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'post_count' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'active' => array('type'=>'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'slug' => array('column' => 'slug', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'parent_id'  => 1,
		'lft'  => 1,
		'rght'  => 1,
		'name'  => 'Lorem ipsum dolor sit amet',
		'slug'  => 'Lorem ipsum dolor sit amet',
		'direct_child_count'  => 1,
		'child_count'  => 1,
		'post_count'  => 1,
		'active'  => 1,
		'created'  => '2009-07-06 21:50:40',
		'modified'  => '2009-07-06 21:50:40'
	));
}
?>