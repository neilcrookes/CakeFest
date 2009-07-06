<?php 
/* SVN FILE: $Id$ */
/* Tag Test cases generated on: 2009-07-06 21:07:56 : 1246913636*/
App::import('Model', 'Tag');

class TagTestCase extends CakeTestCase {
	var $Tag = null;
	var $fixtures = array('app.tag');

	function startTest() {
		$this->Tag =& ClassRegistry::init('Tag');
	}

	function testTagInstance() {
		$this->assertTrue(is_a($this->Tag, 'Tag'));
	}

	function testTagFind() {
		$this->Tag->recursive = -1;
		$results = $this->Tag->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Tag' => array(
			'id'  => 1,
			'tag'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>