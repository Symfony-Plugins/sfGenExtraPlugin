<?php
class constantValidatorSchemaCompare extends sfValidatorSchemaCompare
{
protected function doClean($values)
  {
    if (is_null($values))
    {
      $values = array();
    }

    if (!is_array($values))
    {
      throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
    }

    $leftValue  = isset($values[$this->getOption('left_field')]) ? $values[$this->getOption('left_field')] : null;
    $rightValue = $this->getOption('right_field');

    switch ($this->getOption('operator'))
    {
      case self::GREATER_THAN:
        $valid = $leftValue > $rightValue;
        break;
      case self::GREATER_THAN_EQUAL:
        $valid = $leftValue >= $rightValue;
        break;
      case self::LESS_THAN:
        $valid = $leftValue < $rightValue;
        break;
      case self::LESS_THAN_EQUAL:
        $valid = $leftValue <= $rightValue;
        break;
      case self::NOT_EQUAL:
        $valid = $leftValue != $rightValue;
        break;
      case self::EQUAL:
        $valid = $leftValue == $rightValue;
        break;
      default:
        throw new InvalidArgumentException(sprintf('The operator "%s" does not exist.', $this->getOption('operator')));
    }

    if (!$valid)
    {
      $error = new sfValidatorError($this, 'invalid', array(
        'left_field'  => $leftValue,
        'right_field' => $rightValue,
        'operator'    => $this->getOption('operator'),
      ));
      if ($this->getOption('throw_global_error'))
      {
        throw $error;
      }

      throw new sfValidatorErrorSchema($this, array($this->getOption('left_field') => $error));
    }

    return $values;
  }
}