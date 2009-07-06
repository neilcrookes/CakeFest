<?php 
/* SVN FILE: $Id$ */
/* CategoriesController Test cases generated on: 2009-07-06 22:07:53 : 1246914113*/
App::import('Controller', 'Categories');

class TestCategories extends CategoriesController {
	var $autoRender = false;
}

class CategoriesControllerTest extends CakeTestCase {
	var $Categories = null;

	function startTest() {
		$this->Categories = new TestCategories();
		$this->Categories->constructClasses();
	}

	function testCategoriesControllerInstance() {
		$this->assertTrue(is_a($this->Categories, 'CategoriesController'));
	}

	function endTest() {
		unset($this->Categories);
	}
}
?>