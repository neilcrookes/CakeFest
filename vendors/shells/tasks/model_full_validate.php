<?php
/**
 * ModelFullValidateTask extends ModelTask and adds functionality for prompting
 * for multiple validation rules per field, and parameters for certain rules
 * that accept them.
 *
 * @author Neil Crookes <neil@neilcrookes.com>
 * @link http://www.neilcrookes.com
 * @copyright (c) 2009 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
App::import('Model', 'connection_manager');
App::import('Core', 'console/libs/tasks/model');
class ModelFullValidateTask extends ModelTask {

  /**
   * Placeholder for validation rules and parameters extracted from Core
   * Validation class
   *
   * @var array
   */
  var $validators = array();

  /**
   * Placeholder for validation rules guesses, mapping of rulename => index
   *
   * @var array
   */
  var $guesses = array();

  /**
   * Value for skipping to next field
   *
   * @var string
   */
  var $skip = 'q';

  /**
   * Mapping user entered values to the params to be used in the baked
   * validation rules for the "required" key
   *
   * @var array
   */
  var $requiredValues = array(
    'y' => 'true',
    'n' => 'false',
  );

  /**
   * Mapping user entered values to the params to be used in the baked
   * validation rules for the "allowEmpty" key
   *
   * @var array
   */
  var $allowEmptyValues = array(
    'y' => 'true',
    'n' => 'false',
  );

  /**
   * Mapping user entered values to the params to be used in the baked
   * validation rules for the "on" key
   *
   * @var array
   */
  var $onValues = array(
    'c' => 'create',
    'u' => 'update',
    'b' => 'null',
  );

  /**
   * Mapping user entered values to the params to be used in the baked
   * validation rules for the "last" key
   *
   * @var array
   */
  var $lastValues = array(
    'y' => 'true',
    'n' => 'false',
  );

  /**
   * Default value for the "required" prompt
   *
   * @var string
   */
  var $requiredDefault = 'n';

  /**
   * Default value for the "allowEmpty" prompt
   *
   * @var string
   */
  var $allowEmptyDefault = 'n';

  /**
   * Default value for the "on" prompt
   *
   * @var string
   */
  var $onDefault = 'b';

  /**
   * Default value for the "last" prompt
   *
   * @var string
   */
  var $lastDefault = 'y';

  /**
   * Overrides ModelTask::bake()
   *
   * Calls ModelTask::bake() with no validation, which creates the baked model
   * file and then gets the contents, inserts the validation property, generated
   * by ModelFullValidateTask::bakeValidation() method after the name property
   * and writes the new contents back to the file.
   *
   * It's a filthy hack, but the alternative is copying the entire 170 line
   * ModelTask::bake() method into ModelFullValidateTask and replacing a small
   * portion of it with the new code.
   *
   * @param mixed $name Model name or object
   * @param mixed $associations if array and $name is not an object assume Model associations array otherwise boolean interactive
   * @param array $validate Validation rules
   * @param string $primaryKey Primary key to use
   * @param string $useTable Table to use
   * @param string $useDbConfig Database configuration setting to use
   * @access private
   */
	function bake($name, $associations = array(),  $validate = array(), $primaryKey = 'id', $useTable = null, $useDbConfig = 'default') {

    // Call bake method on ModelTask but with no validation
    $result = parent::bake($name, $associations,  array(), $primaryKey, $useTable, $useDbConfig);

    if (!$result) {
      return $result;
    }

    // Get the contents of the baked file
    $filename = $this->path . Inflector::underscore($name) . '.php';
    $contents = file_get_contents($filename);

    // The string after which we want to insert the validation property
    $addValidationAfterString = "var \$name = '$name';";

    // The position of the above string in the file contents
    $addValidationAfterPos = strpos($contents, $addValidationAfterString);

    // If the string was found
    if ($addValidationAfterPos !== false) {

      // Bake the new validation in full format
      $validation = "\n\n".$this->bakeValidation($validate);

      // Add it into the contents
      $contents = substr_replace($contents, $validation, $addValidationAfterPos+strlen($addValidationAfterString), 0);
      
      // Write the contents back to the file
      file_put_contents($filename, $contents);

    }

    // Return the result of the parent::bake() method
		return $result;
    
  }

  /**
   * Handles validation. Overrides ModelTask::doValidation().
   *
   * @param object $model
   * @param boolean $interactive
   * @return array $validate
   * @access public
   */
  function doValidation(&$model, $interactive = true) {

    if (!is_object($model)) {
      return false;
    }

    $fields = $model->schema();

    if (empty($fields)) {
      return false;
    }

    // Load the validation rules and their params available to be used
    $this->loadValidators();

    // Do not continue if we couldn't load the validators
    if (empty($this->validators)) {
      return false;
    }

    // Setup the validate array ready for populating depending on the user input
    $validate = array();

    // Loop through all the fields in the model schema
    foreach ($fields as $fieldName => $field) {

      $i = 0;

      // While the user does not want to skip to the next field
      $choice = null;
      while ($choice != $this->skip) {

        // Prompt them for a rule they want to impose
        $prompt = $this->prompt($fieldName, $field);

        $guess = $this->skip;

        // If field is not the primary key, or created etc
        if ($fieldName <> $model->primaryKey
          && !in_array($fieldName, array('created', 'modified', 'updated'))) {

          // Get a more educated guess for a rule based on field name and schema
          $attemptGuess = (string)$this->guessRule($fieldName, $field);

          // If attempted guess rulename exists in the guess mapping of
          // rulenames => indexes, set guess to that index
          if (array_key_exists($attemptGuess, $this->guesses)) {
            $guess = $this->guesses[$attemptGuess];
          } else {
            $guess = $attemptGuess;
          }

        }

        // Prompt the user for the their choice of rule, proposing the guess
        $choice = $this->in($prompt, null, $guess);

        // If they don't want to skip to the next field
        if ($choice != $this->skip) {

          // Initialise the rule array which stores data in keys for rule,
          // message, required, allowEmpty etc.
          $rule = array();

          // Get a humanized version of the field name
          $humanFieldName = $this->humanizeFieldName($fieldName);

          // If the choice is numeric and one of the available choices
          if (is_numeric($choice) && isset($this->validators[$choice])) {

            // Initialise the params array which stores parameters sent to the
            // validation rule when it's triggered
            $params = array();

            // Prompt for a value for each param that the selected rule accepts
            // proposing the default value if there is one specified in the
            // method in the validation class, then strip out any empty values
            foreach ($this->validators[$choice]['params'] as $param => $default) {
              $params[] = $this->in($param, null, $default);
            }
            $params = array_filter($params);

            // If the rule has no params, it can be quoted in the baked
            // validation property as a string
            if (empty($params)) {

              $rule['rule'] = $this->validators[$choice]['rule'];

            } else {

              // Else it is the first parameter of an array
              $rule['rule'] = array($this->validators[$choice]['rule']);

              // and is followed by the additional parameters
              foreach($params as $value) {
                $rule['rule'][] = $value;
              }

            }

            // Make a vague attempt at suggesting a message that kind of makes
            // sense... maybe
            $suggestedMessage = $this->suggestMessage($humanFieldName, $field, $rule);

            // Set the key to use for this rule and this field in the validate
            // property
            $key = $this->validators[$choice]['rule'];

          } else {

            // Entered choice was not numeric or not a valid option, so assume
            // it was a regex
            $rule['rule'] = $choice;
            $suggestedMessage = 'Please enter a valid ' . $humanFieldName;
            $key = 'regex'.$i++;

          }
          
          // Prompt the user for the validation message, proposing one
          $rule['message'] = $this->in('Message:', null, $suggestedMessage);

          // Prompt the user for whether this field is required
          $rule['required'] = $this->requiredValues[$this->in('Required? [n]o or [y]es:', null, $this->requiredDefault)];

          // Set the allowEmptyDefault depending on whether
          $allowEmptyDefault = $this->allowEmptyDefault;
          if (isset($field['null'])
            && $field['null'] == true) {
            $allowEmptyDefault = array_search('true', $this->allowEmptyValues);
          }

          // Prompt the user for whether this field can be empty
          $rule['allowEmpty'] = $this->allowEmptyValues[$this->in('Allow Empty? [n]o or [y]es:', null, $allowEmptyDefault)];

          // Prompt the user for whether this rule should be applied on record
          // creation, update or both
          $rule['on'] = $this->onValues[$this->in('On? [c]reate or [u]pdate or [b]oth:', null, $this->onDefault)];

          // Prompt the user for whether the rule should be the last applied
          // if it fails
          $rule['last'] = $this->lastValues[$this->in('Last? [n]o or [y]es:', null, $this->lastDefault)];

          // Add the data to the validate array
          $validate[$fieldName][$key] = $rule;

        }

      }

    }

    return $validate;

  }

  /**
   * Returns a lowercased, humanized string for given field name with "_id"
   * suffix removed
   * 
   * @param string $fieldName
   * @return string
   */
  function humanizeFieldName($fieldName) {

    // Get a humanised version of the field name
    $humanFieldName = strtolower(Inflector::humanize($fieldName));

    // Strip ' id' off the end
    $humanFieldName = str_replace(' id', '', $humanFieldName);

    return $humanFieldName;

  }

  /**
   * Makes an attempt to suggest a vaguely human readable validation message
   * that makes a little more send that the default validation rules.
   *
   * @param string $fieldName
   * @param array $field
   * @param array $rule
   * @return string
   */
  function suggestMessage($humanFieldName, $field, $rule) {

    // Get the rule name
    $ruleName = $rule['rule'];
    if (is_array($ruleName)) {
      $ruleName = $ruleName[0];
    }

    // If we're dealing with the not empty rule
    if (strtolower($ruleName) == 'notempty') {
      $message = 'Please ';
      // If field is an integer, likely that form input will be select tag, else
      // probably a text/varchar field
      if ($field['type'] == 'integer') {
        $message .= 'select ';
      } else {
        $message .= 'enter ';
      }
      // Attempt to get the right indefinite article
      if (in_array($humanFieldName[0], array('a', 'e', 'i', 'o', 'u'))) {
        $message .= 'an ';
      } else {
        $message .= 'a ';
      }
      $message .= str_replace(' id', '', $humanFieldName);
      return $message;
    }

    // Get a humanised version of the rule name
    $humanRuleName = strtolower(Inflector::humanize(Inflector::underscore($ruleName)));

    $message = "The $humanFieldName must be $humanRuleName";

    // If there are parameters, it can make sense to append these to the message
    if (is_array($rule['rule'])) {
      $params = $rule['rule'];
      unset($params[0]);
      $message .= ' '.implode(' and ', $params);
    }

    return $message;

  }

  /**
   * Uses PHP5 reflection API to introspect the cake core validation class
   * to identify the methods available, what parameters they accept and what
   * their default values are.
   *
   * Builds up an array in this->validators property of $i => rule names and
   * params, and also the reverse guesses mapping property of rule name => $i
   *
   * @return array
   */
  function loadValidators() {

    if (!class_exists('Validation')) {
      return;
    }

    // Get an array of objects representing the methods available on the
    // Validation class
    $rf = new ReflectionClass('Validation');
    $methods = $rf->getMethods();
    if (empty($methods)) {
      return;
    }

    // For each method
    $i=1;
    foreach ($methods as $method) {

      $methodName = $method->getName();

      // Skip non public, parent or getInstance methods as these are not valid
      // validation rules
      if (substr($methodName,0,1) == '_'
      || $method->isPublic() == false
      || $method->getDeclaringClass()->getName() != 'Validation'
      || $methodName == 'getInstance') {
        continue;
      }

      // Discover and process the method parameters
      $params = array();
      foreach ($method->getParameters() as $param) {

        $paramName = $param->getName();

        // All have a param 'check' which is the value you are validating, so
        // ignore this one.
        if (substr($paramName,0,5) == 'check') {
          continue;
        }

        // Get the default value for a param declared in the method prototype
        // in the validation class, e.g. function x(y=1, z=2) {}
        if ($param->isDefaultValueAvailable()) {
          $params[$paramName] = $param->getDefaultValue();
        } else {
          $params[$paramName] = null;
        }

      }

      // Add validation rule name and params to the validators property in index
      // $i
      $this->validators[$i] = array(
      	'rule' => $methodName,
      	'params' => $params
      );

      // Add the reverse map methodname => index $i into the guesses property
      $this->guesses[(string)$methodName] = $i;

      $i++;

    }

  }

  /**
   * Attempts to guess the rule to use depending on the field name and the field
   * properties in the model schema
   *
   * @param string $fieldName
   * @param array $field
   * @return string
   */
  function guessRule($fieldName, $field) {

    if (in_array($fieldName, array('email', 'email_address'))) {
      return 'email';
    }
    if (in_array($fieldName, array('ip', 'ip_address'))) {
      return 'ip';
    }
    if (in_array($fieldName, array('price', 'cost'))) {
      return 'money';
    }
    if (in_array($fieldName, array('phone', 'tel', 'mobile'))) {
      return 'phone';
    }
    if (in_array($fieldName, array('ssn'))) {
      return 'ssn';
    }
    if (in_array($fieldName, array('slug'))) {
      return '/^[a-z0-9\_\-]*$/i';
    }
    if (in_array($fieldName, array('cc', 'card_number'))) {
      return 'cc';
    }
    if (in_array($fieldName, array('url', 'link', 'website'))) {
      return 'url';
    }
    if ($field['type'] == 'string') {
      return 'notEmpty';
    }
    if ($field['type'] == 'integer') {
      return 'numeric';
    }
    if ($field['type'] == 'boolean') {
      return 'boolean';
    }
    if ($field['type'] == 'datetime') {
      return '/^\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}$/i';
    }

    return $this->skip;

  }

  /**
   * Generates the prompt string to output to prompt the user to select a rule.
   * Rules are organised in 3 columns for easier viewing
   *
   * @param string $fieldName
   * @param array $field
   * @return string
   */
  function prompt($fieldName, $field) {

    $prompt = 'Name: ' . $fieldName . "\n";
    $prompt .= 'Type: ' . $field['type'] . "\n";
    $prompt .= '---------------------------------------------------------------'."\n";
    $prompt .= 'Please select one of the following validation options:'."\n";
    $prompt .= '---------------------------------------------------------------'."\n";

    // Display the validation rules in 3 columns
    foreach ($this->validators as $key => $validator) {
      $prompt .= str_pad("$key. {$validator['rule']}", 18, ' ', STR_PAD_RIGHT);
      $prompt .= $key % 3 == 0 ? "\n" : "\t";
    }

    $prompt .= "\n\nq - Do not do any more validation on this field.\n";
    $prompt .= "... or enter in a valid regex validation string.\n\n";

    return $prompt;

  }

  /**
   * Generates the validate property string to be added to the baked model file.
   * It is the most verbose format of the validate property, i.e. all keys
   *
   * @param array $validate
   * @return string
   */
  function bakeValidation($validate) {

    $out = '';

    if (count($validate)) {
      $out .= "\tvar \$validate = array(\n";
      foreach ($validate as $field => $rules) {
        $out .= "\t\t'{$field}' => array(\n";
        foreach ($rules as $key => $rule) {
          $out .= "\t\t\t'$key' => array(\n";
          foreach ($rule as $key => $params) {
            $out .= "\t\t\t\t'$key' => ";
            if ($key=='rule'
            && is_array($params)) {
              $out .= 'array(';
              foreach ($params as $param) {
                if (is_numeric($param)
                || in_array($param, array('true', 'false', 'null'))) {
                  $out .= $param . ', ';
                } else {
                  $out .= "'$param', ";
                }
              }
              $out .= "),\n";
            } else {
              if (is_numeric($params)
              || in_array($params, array('true', 'false', 'null'))) {
                $out .= "$params,\n";
              } else {
                $out .= "'$params',\n";
              }
            }
          }
          $out .= "\t\t\t),\n";
        }
        $out .= "\t\t),\n";
      }
      $out .= "\t);\n\n";
    }

    return $out;

  }

}

?>