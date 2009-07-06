<?php 
/* SVN FILE: $Id$ */
/* Category Test cases generated on: 2009-07-06 21:07:40 : 1246913440*/
App::import('Model', 'Category');

class CategoryTestCase extends CakeTestCase {
	var $Category = null;
	var $fixtures = array('app.category', 'app.post');

	function startTest() {
		$this->Category =& ClassRegistry::init('Category');
	}

	function testCategoryInstance() {
		$this->assertTrue(is_a($this->Category, 'Category'));
	}

	function testCategoryFind() {
		$this->Category->recursive = -1;
		$results = $this->Category->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Category' => array(
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
		$this->assertEqual($results, $expected);
	}
}
?>