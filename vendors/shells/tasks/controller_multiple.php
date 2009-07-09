<?php
/**
 * ControllerMultipleTask extends ControllerTask and adds functionality for
 * selecting multiple controllers that you want to bake views for at the same
 * time.
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