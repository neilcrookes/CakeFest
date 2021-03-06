<?php
/**
 * BakeExtrasShell extends BakeShell and is used for executing custom tasks e.g.
 * - ModelFullValidate
 * - ViewMultiple
 * - ControllerMultiple
 *
 * @author Neil Crookes <neil@neilcrookes.com>
 * @link http://www.neilcrookes.com
 * @copyright (c) 2009 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
App::import('Core', 'bake');
class BakeExtrasShell extends BakeShell {

  /**
   * The tasks that this shell uses
   * @var array
   */
  var $tasks = array('ModelFullValidate', 'ViewMultiple', 'ControllerMultiple');

  /**
   * Run when shell invoked
   */
  function main() {

    parent::loadTasks();

		$this->out('Bake Extras Shell');
		$this->hr();
		$this->out('[M]odel Full Validate');
		$this->out('[V]iew Multiple');
		$this->out('[C]ontroller Multiple');
		$this->out('[Q]uit');

    // Prompt the user for the class to bake
		$classToBake = strtoupper($this->in(__('What would you like to Bake?', true), array('M', 'V', 'C', 'Q')));

    // Call execute on the task corresponding to the selected class to bake
		switch($classToBake) {
			case 'M':
				$this->ModelFullValidate->execute();
				break;
			case 'V':
				$this->ViewMultiple->execute();
				break;
			case 'C':
				$this->ControllerMultiple->execute();
				break;
			case 'Q':
				exit(0);
				break;
			default:
				$this->out(__('You have made an invalid selection. Please choose a type of class to Bake by entering M, V, C or Q to quit.', true));
		}

		$this->hr();
		$this->main();
    
  }

  /**
   * Displays help contents
   *
   * @access public
   */
	function help() {
		$this->out('Bake Extras:');
		$this->hr();
		$this->out('The Bake Extras script generates models, views and controllers for your application.');
		$this->out('It does not currently support any command line arguments');
		$this->hr();
		$this->out("Usage: cake bake_extras");
		$this->hr();
		$this->out('Commands:');
		$this->out("\n\tbake help\n\t\tshows this help message.");
	}

}

?>