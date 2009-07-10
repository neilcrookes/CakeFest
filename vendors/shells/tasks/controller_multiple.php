<?php
/**
 * ControllerMultipleTask extends ControllerTask and adds functionality for
 * selecting multiple controllers that you want to bake views for at the same
 * time.
 *
 * ControllerMultipleTask can also bake your controllers with default settings
 * so you don't have to do it interactively each time.
 *
 * It can also bake just non-admin actions or non-admin and admin actions or
 * just admin actions.
 *
 * You can select a single controller, multiple or all controllers.
 *
 * @author Neil Crookes <neil@neilcrookes.com>
 * @link http://www.neilcrookes.com
 * @copyright (c) 2009 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
App::import('Core', 'console/libs/tasks/controller');
App::import('Model', 'connection_manager');
class ControllerMultipleTask extends ControllerTask {

  /**
   * Other tasks this task uses
   * @var array
   */
  var $tasks = array('ViewMultiple');

  /**
   * Main function called by shell
   */
  function execute() {

    parent::loadTasks();

    // Get the array of actions to bake into the controller
    $actions = $this->ViewMultiple->getActions();

    // @todo Quick fix for switching on/off admin/non admin actions - to be
    // replaced by more granular control
    $admin = $this->getAdmin();
    $nonAdminActions = $adminActions = false;
    foreach ($actions as $action) {
      if (strpos($action, $admin) !== false) {
        $adminActions = true;
      } else {
        $nonAdminActions = true;
      }
    }

    // Get the array of controllers to bake the selected actions for
    $controllerNames = $this->getNames();

    // For each controller
    foreach ($controllerNames as $controllerName) {

      // @todo Quick fix for switching on/off admin/non admin actions - to be
      // replaced by more granular control
      $actions = '';
      if ($nonAdminActions) {
        $actions .= $this->bakeActions($controllerName);
      }
      if ($adminActions) {
        $actions .= $this->bakeActions($controllerName, $admin);
      }

      // Bake the controller
			$baked = $this->bake($controllerName, $actions);

      // If baked OK check if user wants controller unit test baked
			if ($baked && $this->_checkUnitTest()) {
				$this->bakeTest($controllerName);
			}

      $this->hr();

    }

    $this->out(__("Controller Baking Complete.\n", true));

  }

  /**
   * Replaces getName() (singular) in ControllerTask to return an array of one,
   * multiple or all controller names. Displays available controllers and
   * prompts the user to make a selection
   *
   * @return array
   */
  function getNames() {

    // Get a list of all controllers, method available on ControllerTask
    $controllers = $this->listAll('default', 'Controllers');

    // While the user has not made a selection
    $enteredController = '';
    while ($enteredController == '') {

      // Prompt them for a selection
      $enteredController = $this->in(__("Enter one or more numbers from the list above separated by a space, or type in the names of one or more other controllers, 'a' for all or 'q' to exit", true), null, 'q');

      // Quit if they want to
      if (strtolower($enteredController) === 'q') {
        $this->out(__("Exit", true));
        $this->_stop();
      }

      // Validate they entered something
      if ($enteredController == '') {
        $this->out(__('Error:', true));
        $this->out(__("The Controller name you supplied was empty. Please try again.", true));
      }

    }

    // If they want all controllers return all controller names that have models
    if (strtolower($enteredController) == 'a') {
      return $this->getAllWithModels();
    }

    // Make an array of the input from the user, by splitting on non
    // alphanumeric characters if multiple
    if (preg_match('/[^a-z0-9]/i', $enteredController)) {
      $enteredControllers = preg_split('/[^a-z0-9]/i', $enteredController);
    } else {
      $enteredControllers = array($enteredController);
    }

    // For each value the user entered, check if they entered a number
    // corresponding to one of the options, else assume they entered the name of
    // the controller they want, so camelise it.
    $controllerNames = array();
    foreach ($enteredControllers as $enteredController) {
      if (intval($enteredController) > 0 && intval($enteredController) <= count($controllers) ) {
        $controllerNames[] = $controllers[intval($enteredController) - 1];
      } else {
        $controllerNames[] = Inflector::camelize($enteredController);
      }
    }

    return $controllerNames;

  }

  /**
   * Returns an array of controller names for which there is a model. Does not
   * include controller names for "Join" or "With" or "Through" models that
   * modelise HABTM join tables.
   *
   * @return array
   */
  function getAllWithModels() {

    $controllerNamesWithModels = array();

    foreach ($this->_controllerNames as $controllerName) {

      // Get the model name for a given controller name
      $model = $this->_modelName($controllerName);

      // Check the model exists, if it does, remember this controller name
      if (App::import('Model', $model)) {
        $controllerNamesWithModels[] = $controllerName;
      }

    }

    return $controllerNamesWithModels;

  }

}

?>