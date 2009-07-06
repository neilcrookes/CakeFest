<?php 
/* SVN FILE: $Id$ */
/* Comment Fixture generated on: 2009-07-06 21:07:44 : 1246913504*/

class CommentFixture extends CakeTestFixture {
	var $name = 'Comment';
	var $table = 'comments';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'post_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'name' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'email' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'website' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'comment' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'active' => array('type'=>'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'post_id'  => 1,
		'name'  => 'Lorem ipsum dolor sit amet',
		'email'  => 'Lorem ipsum dolor sit amet',
		'website'  => 'Lorem ipsum dolor sit amet',
		'comment'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'active'  => 1,
		'created'  => '2009-07-06 21:51:44',
		'modified'  => '2009-07-06 21:51:44'
	));
}
?>