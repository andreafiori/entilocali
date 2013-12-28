<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\Model\SetupManager;
use Application\Entity\Categories;
use Application\Entity\Posts;
use Setup\Model\StringRequestDecoder;
use Posts\Model\PostsRelationsRepository;
use Categories\Model\CategoriesRepository;
use Posts\Model\PostsRepository;

/**
 * Frontend main controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManager = new SetupManager($this);
    	$setupManager->setEntityManager( $this->getServiceLocator()->get('entityManagerService') );
    	$setupManager->setInput( 
    		array(
    			'channel' => 1,
    			'isbackend' => 0,
    			'controller' => $this->params()->fromRoute('controller'),
    			'action'	 => $this->params()->fromRoute('action'),
    			'languageAbbreviation' => strtolower( $this->params()->fromRoute('lang') )
    		)
    	);
		$templateData = $setupManager->setSetupRecord();
		
		$input = $setupManager->getInput();
			
		//var_dump($setupManager->getChannelEntity());
		// Redirect if the lang is not set
		/*
		if ( !$this->params()->fromRoute('lang') ) {
			$this->redirect()->toUrl("/zf2-apicms/".$templateData['languageDefault']->getAbbreviation1()."/");
		}
		*/
		
		// Given the category name, get the list of posts OR the post data to show details
		$stringRequestDecoder = new StringRequestDecoder();
		$categoryName = $stringRequestDecoder->denormalize( $this->params()->fromRoute('category'));
		
		$categories = new CategoriesRepository($setupManager->getEntityManager());
		$categories = $categories->getFindFromRepository(array("name"=>$categoryName));
			// Se non trova la categoria, stop e rimanda a pagina con messaggio oppure redirect
		$categoryEntity = new Categories();
		$categoryEntity->setId($categories[0]['id']);
			// se non trova nulla fra le relazioni, redirect
		$postsRelations = new PostsRelationsRepository($setupManager->getEntityManager());
		$postsList = $postsRelations->getFindFromRepository(array("category"=>$categoryEntity));
			// posts trovati sulle relazioni possono essere + di uno
		$postsRepository = new PostsRepository($setupManager->getEntityManager());
		$postsDetail = $postsRepository->getFindFromRepository(array("id" => $postsList[0]['id']));

		$templateData['templatedir'] = 'frontend/projects/'.$templateData['frontendprojectdir'].'templates/'.$templateData['frontendTemplate'];
		$templateData['templatePartial'] = $templateData['templatedir'].'contents/detail.phtml';
		if (!$templateData['templatePartial']) {
			$templateData['templatePartial'] = $templateData['templatedir'].'homepage.phtml';
		}
		$templateData['imagedir'] = $templateData['templatedir'].'assets/images/';
		$templateData['cssdir']   = $templateData['templatedir'].'assets/css/';
 		$templateData['jsdir'] 	  = $templateData['templatedir'].'assets/js/';
 		$templateData['controllerResult'] = $postsDetail[0];
 		
    	$this->layout($templateData['basiclayout']);
    	$this->layout()->setVariable("templateData", $templateData);
    	
    	return new ViewModel();
    }
}
