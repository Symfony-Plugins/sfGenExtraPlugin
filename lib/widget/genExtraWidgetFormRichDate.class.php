<?php
/**
* genExtraWidgetFormRichDate is a rich date widget for 1.1+ forms
*
* @author Matt Daum matt [at] setfive.com
*/
class genExtraWidgetFormRichDate extends sfWidgetFormDate
{

  /**
   * Configures the current widget.
   *
   * Available options:
   *
   *  * rich:       Allows to turn off rich rendering when 12 hour time is needed because it does not display good when rich
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->addOption('rich', true);
  }

  /**
  * @param string $name The element name
  * @param string $value The value displayed in this widget
  * @param array $attributes An array of HTML attributes to be merged with the default HTML attributes
  * @param array $errors An array of errors for the field
  *
  * @return string An HTML tag string
  *
  * @see sfWidgetForm
  */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $attributes = array_merge($this->attributes, $attributes);
    
    //Get the date input function from Form helper
    use_helper('Form');
    //Make the widget rich or not
    $attributes['rich'] = $this->getOption('rich');
    if (isset($attributes['withtime']))
      $attributes['format'] = "yyyy-MM-dd hh:mm";
    else
      $attributes['format'] = "yyyy-MM-dd";
    return input_date_tag($name,$value, $attributes);
  }
}