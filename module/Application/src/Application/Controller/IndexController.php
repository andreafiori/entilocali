<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\Model\SetupManager;
use Application\Entity\Categories;
use Application\Entity\Posts;
use Setup\Model\StringRequestDecoder;
use Posts\Model\PostsRelationsRepository;

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
		$setupManager->setInput( array( 'channel' => 1, 'isbackend' => 0 ) );

		$input = $setupManager->getInput();

		$templateData = $setupManager->setSetupRecord();
		$templateData['templatePartial'] = 'frontend/projects/'.$templateData['frontendprojectdir'].'templates/'.$templateData['frontendTemplate'].'homepage.phtml';

		// Redirect if the lang is not set
		/*
		if ( !$this->params()->fromRoute('lang') ) {
			$this->redirect()->toUrl("/zf2-apicms/".$templateData['languageDefault']->getAbbreviation1()."/");
		}
		*/
		
		// Given the category name, get the list of posts OR the post data to show details
		
		$stringRequestDecoder = new StringRequestDecoder();
		$categoryName = $stringRequestDecoder->denormalize( $this->params()->fromRoute('category'));
		
		//$categoriesRepository = new CategoriesRepository($setupManager->getEntityManagerService());
		//var_dump( $categoriesRepository->getFindFromRepository(array("name"=>$categoryName)) );
		/*
		$categories = new Categories();
		$categories->setName($categoryName);

		$postsRelations = new PostsRelations();
		var_dump( $postsRelations->setCategory($categories) );
		*/

		$postsRelations = new PostsRelationsRepository($setupManager->getEntityManagerService());
		//var_dump ( $postsRelations->getFindFromRepository() );
		
    	$this->layout($templateData['basiclayout']);
    	$this->layout()->setVariable("templateData", $templateData);
    	
    	return new ViewModel();
    }
}
