<?php

/**
 * Effectively acts as an extension of sfForm
 * 
 * @package     sfSympalPlugin
 * @subpackage  form
 * @author      Jonathan H. Wage <jonwage@gmail.com>
 * @since       2010-03-27
 * @version     svn:$Id$ $Author$
 */
class sfSympalForm extends sfSympalExtendClass
{

  /**
   * Returns an array of all of the field names that are required
   * 
   * @param sfValidatorSchema $validatorSchema The validator schema to check on
   * @param string $format The name format - used mostly so this can call itself recursively
   * 
   * @return array
   */
  public function getRequiredFields(sfValidatorSchema $validatorSchema = null, $format = null)
  {
    if ($validatorSchema === null)
    {
      $validatorSchema = $this->getValidatorSchema();
    }
    if ($format === null)
    {
      $format = $this->getWidgetSchema()->getNameFormat();
    }
    $fields = array();

    foreach ($validatorSchema->getFields() as $name => $validator)
    {
      $field = sprintf($format, $name);
      if ($validator instanceof sfValidatorSchema)
      {
        // recur
        $fields = array_merge(
          $fields,
          $this->getRequiredFields($validator, $field.'[%s]')
        );
      }
      else if ($validator->getOption('required'))
      {
        // this field is required
        $fields[] = $field;
      }
    }

    return $fields;
  }

  /**
   * Whether or not this form should have a recaptcha field added to it
   * 
   * This is called by the following events so that the addition and processing
   * of this field occurs automatically:
   *   - form.post_configure Adds the recaptcha field
   *   - form.filter_values: Processes the submitted value
   * 
   * @return boolean
   */
  public function hasRecaptcha()
  {
    // No recaptcha in test environment
    if (sfConfig::get('sf_environment') === 'test')
    {
      return false;
    }
    $forms = sfSympalConfig::get('recaptcha_forms', null, array());
    $class = get_class($this->getSubject());

    return (in_array($class, $forms) || (array_key_exists($class, $forms) && $forms[$class])) ? true : false;
  }
}