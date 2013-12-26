<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\Model\SetupManager;

/**
 * Frontend main controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupController = new SetupManager($this);
		$setupController->setInput( array( 'channel' => 1, 'isbackend' => 0 ) );
		$input = $setupController->getInput();
		
		$templateData = $setupController->setSetupRecord();
		$templateData['templatePartial'] = 'frontend/projects/'.$templateData['frontendprojectdir'].'templates/'.$templateData['frontendTemplate'].'homepage.phtml';

		// Redirect if the lang is not set
		/*
		if ( !$this->params()->fromRoute('lang') ) {
			$this->redirect()->toUrl("/zf2-apicms/".$templateData['languageDefault']->getAbbreviation1()."/");
		}
		*/

    	$this->layout($templateData['basiclayout']);
    	$this->layout()->setVariable("templateData", $templateData);

    	return new ViewModel();
    }
}
