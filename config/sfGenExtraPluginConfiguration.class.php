<?php

/**
 * sfGenExtraPlugin configuration.
 * 
 * @package     sfGenExtraPlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id: PluginConfiguration.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
class sfGenExtraPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
  	if (!sfConfig::get('app_gen_extra_disable_pre_execute_listener'))
  	  $this->dispatcher->connect('admin.pre_execute', array('genExtraListeners', 'listenToPreExecute'));
  }
}
