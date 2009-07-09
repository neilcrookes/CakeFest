<?php
/**
 * Helper intended for use in admin section of application.
 *
 * @author Neil Crookes <neil@neilcrookes.com>
 * @link http://www.neilcrookes.com
 * @copyright (c) 2009 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class AdminHelper extends AppHelper {

  /**
   * Array of helpers this helper uses
   * @var array
   */
  var $helpers = array('Form');

  /**
   * Drop in replacement for FormHelper::input which adds additional logic for
   * determining whether to display certain fields, what type to use, and
   * setting additional CSS class names
   *
   * @param string $fieldName
   * @param array $options
   * @return string
   */
  function input($fieldName, $options = array()) {

    // Do not display TreeBehavior lft and rght fields
    if (in_array($fieldName, array('lft', 'rght'))) {
      return;
    }

    // Do not display counter cache fields
    $isCount = substr($fieldName, -6) === '_count';
    if ($isCount) {
      return;
    }

    // Determine if this field is a key
    $isKey = substr($fieldName, -3) === '_id';

    // Determine if this field is a HABTM
    $this->Form->setEntity($fieldName);
    $isHabtm = $this->Form->model() === $this->Form->field();

    // If field is a key or habtm and options are not specified in options array
    if (($isKey || $isHabtm) && !isset($options['options']))  {
      // Try and get the options from the view vars
      $view =& ClassRegistry::getObject('view');
      $varName = Inflector::variable(
        Inflector::pluralize(preg_replace('/_id$/', '', $fieldName))
      );
      $varOptions = $view->getVar($varName);
      // If options is not an array, or empty, don't display the field
      if (!is_array($varOptions) || empty($varOptions)) {
        return;
      }
    }

    // Set default options required by CSS
    $defaults = array(
      'label' => array('class' => 'label'),
    );

    // If HABTM, set multiple type and various classnames
    if ($isHabtm) {
      $defaults['multiple'] = $defaults['class'] = $defaults['label']['class'] = 'checkbox';
    }

    // Set classnames depending to field type required by CSS
    $model =& ClassRegistry::getObject($this->model());
    $type = $model->getColumnType($fieldName);
    switch ($type) {
      case 'string':
        $defaults['class'] = 'text';
        break;
      case 'boolean':
        $defaults['class'] = $defaults['label']['class'] = 'checkbox';
        break;
    }

    // Merge defaults with options
    $options = Set::merge($defaults, $options);

    // Return the form input markup
    return $this->Form->input($fieldName, $options);

  }
  
}
?>
