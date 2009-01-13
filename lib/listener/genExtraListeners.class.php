<?php
class genExtraListeners
{
	/**
	 * This listener when connected to the the admin.pre_execute event
	 * enables a 3 way sort when clicking on a column header
	 * First click sort asc, second click sorts desc, third click removes sort
	 *
	 * @param sfEvent $event
	 */
	public function listenToPreExecute(sfEvent $event)
	{
		$context = sfContext::getInstance();
		if (!sfConfig::get('app_gen_extra_disable_3_way_sort')) {
			if ($context->getActionName() == 'index' && $context->getRequest()->getParameter('sort')) {
			  $currentSort = $context->getUser()->getAttribute($context->getModuleName().'.sort', null, 'admin_module');
				
			  if (  $currentSort[1] == 'desc' && $context->getRequest()->getParameter('sort') == $currentSort[0]) {
			    $context->getUser()->setAttribute($context->getModuleName().'.sort', array(null, null), 'admin_module') ;
			    $context->getActionStack()->getLastEntry()->getActionInstance()->redirect($context->getModuleName().'/index');
			  }
			}
		}
	}
}