<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorNumberRange valinumbers a range of number. It also converts the input values to valid numbers.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorNumberRange.class.php 11671 2008-09-19 14:07:21Z fabien $
 */
class genExtraValidatorNumberRange extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * from_number:   The from number validator (required)
   *  * to_number:     The to number validator (required)
   *
   * @param array $options    An array of options
   * @param array $messages   An array of error messages
   *
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('invalid', 'The begin number must be before the end number.');

    $this->addRequiredOption('from_number');
    $this->addRequiredOption('to_number');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $value['from'] = $this->getOption('from_number')->clean(isset($value['from']) ? $value['from'] : null);
    $value['to']   = $this->getOption('to_number')->clean(isset($value['to']) ? $value['to'] : null);

    if ($value['from'] && $value['to'])
    {
      $v = new sfValidatorSchemaCompare('from', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'to', array('throw_global_error' => true), array('invalid' => $this->getMessage('invalid')));
      $v->clean($value);
    }

    return $value;
  }
}
