<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\TemplateMapResolver;
use Zend\View\Model\ViewModel; // use Zend\View\Helper\ViewModel; why there are 2 ViewModel ???

/**
 * Home page controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
	/*
    public function indexAction()
    {
		$phpRenderer = new PhpRenderer();
		$resolver = new TemplateMapResolver();
		$resolver->setMap(array(
			'frontend' => __DIR__ . '/../../../../../public/frontend/templates/fossobandito/default/layout.phtml'
		));
		$phpRenderer->setResolver($resolver);
		
		$viewModel = new ViewModel();
		$viewModel->setTemplate('frontend');
		
    	return $viewModelToReturn;
    	
    	
    	$this->layout('frontend/templates/fossobandito/default/layout.phtml');
    	return array( new ViewModel() );
    }
    */
    
    /**
     * TODO: get var template path, render the child template
     * @return array with viewModel object lets return an HTTP 200 status on ZfTool
     */
    public function indexAction()
    {   	
    	$this->layout('frontend/templates/fossobandito/default/layout.phtml');
    	return array( $viewModel );
    }
}
