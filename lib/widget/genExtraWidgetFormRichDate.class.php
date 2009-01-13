<?php
/**
* genExtraWidgetFormRichDate is a rich date widget for 1.1+ forms
*
* @author Matt Daum matt [at] setfive.com
*/
class genExtraWidgetFormRichDate extends sfWidgetFormDate
{

  /**
  * @param array $options An array of options
  * @param array $attributes An array of default HTML attributes
  *
  * @see sfWidgetForm
  */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
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
    //Get the date input function from Form helper
    use_helper('Form');
    //Make the widget rich
    $attributes['rich']=true;
    return input_date_tag($name,$value, $attributes);
  }
}