<?php
/**
 * ViewMultipleTask extends the ViewTask and adds functionality to bake
 * individual or selected multiple actions views rather than just all admin and
 * non-admin or just non-admin actions as provided by the core ViewTask.
 *
 * Also utilises ControllerMultipleTask (which extends ControllerTask) to
 * provide functionality for selecting multiple or all controllers that you want
 * to bake views for.
 * 
 * @author Neil Crookes <neil@neilcrookes.com>
 * @link http://www.neilcrookes.com
 * @copyright (c) 2009 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
App::import('Core', 'console/libs/tasks/view');
class ViewMultipleTask extends ViewTask {

  /**
   * Tasks used by this task
   * @var array:
   * - ControllerMultiple used to get multiple controller names to bake the
   * selected views for.
   */
  var $tasks = array('ControllerMultiple');

  /**
   * Main function called by shell
   */
  function execute() {

    parent::loadTasks();

    // Get the array of actions to bake the views for
    $actions = $this->getActions();

    // Get the array of controllers to bake the selected views for
    $controllerNames = $this->ControllerMultiple->getNames();

    // For each controller
    foreach ($controllerNames as $controllerName) {

      // Set ViewTask properties in preparation for bake
      $this->controllerName = $controllerName;
      $this->controllerPath = low(Inflector::underscore($controllerName));

      // Foreach selected action, bake the view for it
      foreach ($actions as $action) {
        $this->template = $action;
        $this->bake($action, true);
      }

      $this->hr();

    }

    $this->out(__("View Baking Complete.\n", true));

  }

  /**
   * Retusn the actions for the option selected by the user from the list of
   * available actions and action combinations. E.g. a user may select all
   * actions, just admin actions, just form based actions or just a single one
   * 
   * @return array
   */
  function getActions() {

    $this->out(__("What actions should we create views for?", true));

    // Get the available actions
    $availableActions = $this->getAvailableActions();

    // Display the options to the user
    $availableCount = count($availableActions);
    for ($i=0; $i<$availableCount; $i++) {
      $this->out($i + 1 . '. ' . __($availableActions[$i]['label'], true));
    }

    // While the user hasn't selected a valid option
    $enteredAction = '';
    while ($enteredAction == '') {

      // Prompt them for a valid option
      $enteredAction = $this->in(__("Enter a number from the list above, or 'q' to exit", true), null, 'q');

      // Exit if that's what they want to do
      if ($enteredAction === 'q') {
        $this->out(__("Exit", true));
        $this->_stop();
      }

      // Validate the entered action
      if ($enteredAction == '' || intval($enteredAction) > $availableCount) {
        $this->out(__('Error:', true));
        $this->out(__("The number you supplied was empty, or  was not an option. Please try again.", true));
        $enteredAction = '';
      }
    }

    // Return the list of actions for their selection
    return $availableActions[intval($enteredAction) - 1]['actions'];

  }

  /**
   * Returns an array of available actions and combined available actions that
   * could be baked. Options include:
   *
   * - all admin and non admin
   * - all admin
   * - admin add & edit
   * - all non admin
   * - non admin add & edit
   * - admin add
   * - admin edit
   * - admin index
   * - admin delete
   * - non admin add
   * - non admin edit
   * - non admin index
   * - non admin delete
   *
   * where admin is the value for admin routing.
   *
   * @return array
   */
  function getAvailableActions() {

    // Get admin routing prefix
    $admin = $this->getAdmin();

    // Build up admin & non admin actions arrays based on scaffold actions
    $allAdmin = $allNonAdmin = array();
    foreach ($this->scaffoldActions as $scaffoldAction) {
      $allAdmin[] = $admin . $scaffoldAction;
      $allNonAdmin[] = $scaffoldAction;
    }

    // Merge admin & non admin to get all
    $all = array_merge($allAdmin, $allNonAdmin);

    // Initialise available actions array with all, all admin, all admin forms
    // and all non-admin and all non-admin forms
    $availableActions = array(
      array(
        'label' => 'All',
        'actions' => $all,
      ),
      array(
        'label' => "All $admin",
        'actions' => $allAdmin,
      ),
      array(
        'label' => "{$admin}add and {$admin}edit",
        'actions' => array(
          $admin.'add',
          $admin.'edit',
        ),
      ),
      array(
        'label' => "All non $admin",
        'actions' => $allNonAdmin,
      ),
      array(
        'label' => "add and edit",
        'actions' => array(
          'add',
          'edit',
        ),
      ),
    );

    // Adding individual admin and non admin scaffold actions to the available
    // actions array
    $availableCount = count($availableActions);
    $scaffoldCount = count($this->scaffoldActions);
    foreach ($this->scaffoldActions as $i => $scaffoldAction) {
      $availableActions[$availableCount+$i] = array(
        'label' => $admin . $scaffoldAction,
        'actions' => array($admin . $scaffoldAction),
      );
      $availableActions[$availableCount+$scaffoldCount+$i] = array(
        'label' => $scaffoldAction,
        'actions' => array($scaffoldAction),
      );
    }

    return $availableActions;

  }

}

?>