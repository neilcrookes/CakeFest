<?php 
/* SVN FILE: $Id$ */
/* Post Fixture generated on: 2009-07-06 21:07:36 : 1246913616*/

class PostFixture extends CakeTestFixture {
	var $name = 'Post';
	var $table = 'posts';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'category_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'title' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'slug' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'abstract' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'body' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'comment_count' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'active' => array('type'=>'boolean', 'null' => false, 'default' => '1'),
		'published' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'slug' => array('column' => 'slug', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'category_id'  => 1,
		'title'  => 'Lorem ipsum dolor sit amet',
		'slug'  => 'Lorem ipsum dolor sit amet',
		'abstract'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'body'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'comment_count'  => 1,
		'active'  => 1,
		'published'  => '2009-07-06 21:53:36',
		'created'  => '2009-07-06 21:53:36',
		'modified'  => '2009-07-06 21:53:36'
	));
}
?>