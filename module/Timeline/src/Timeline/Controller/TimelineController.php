<?php

namespace Timeline\Controller;

use Application\Controller\FrontendControllerAbstract;
use Zend\View\Helper\ViewModel;

/**
 * @author Andrea Fiori
 * @since  07 February 2014
 */
class TimelineController extends FrontendControllerAbstract
{
	public function indexAction()
	{
		$setupManager = $this->generateSetupManagerFromInitializerPlugin();
		
		$viewModel = new ViewModel();
		
		return $viewModel;
	}
}