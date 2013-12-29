<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Categories;
use Application\Entity\Posts;
use Setup\StringRequestDecoder;
use Setup\SetupManager;
use Posts\Model\PostsRelationsRepository;
use Posts\Model\PostsRepository;
use Categories\Model\CategoriesRepository;
use Posts\Model\postsAliasGetter;

/**
 * Frontend main controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManager = new SetupManager(
    			array(
    				'channel' => 1,
    				'isbackend' => 0,
    				'controller' => $this->params()->fromRoute('controller'),
    				'action'	 => $this->params()->fromRoute('action'),
   					'languageAbbreviation' => strtolower( $this->params()->fromRoute('lang') )
    			)
    	);
    	$setupManager->setEntityManager( $this->getServiceLocator()->get('entityManagerService') );
		$setupManager->setSetupRecord();

		// Given the category name, get the list of posts OR the post data to show details
		$stringRequestDecoder = new StringRequestDecoder();
		$categoryName = $stringRequestDecoder->denormalize( $this->params()->fromRoute('category') );

		$categories = new CategoriesRepository($setupManager->getEntityManager());
		$categories = $categories->convertArrayOfObjectToArray( $categories->getFindFromRepository(array("name" => $categoryName)) );
		
			// Se non trova la categoria, stop e rimanda a pagina con messaggio oppure redirect
		$categoryEntity = new Categories();
		$categoryEntity->setId($categories[0]['id']);
		
			// se non trova nulla fra le relazioni, redirect
		$postsRelations = new PostsRelationsRepository($setupManager->getEntityManager());
		$postsList = $postsRelations->convertArrayOfObjectToArray( $postsRelations->getFindFromRepository(array("category"=>$categoryEntity)) );
		
			// posts trovati sulle relazioni possono essere + di uno
		$postsRepository = new PostsRepository($setupManager->getEntityManager());
		$postsDetail = $postsRepository->convertArrayOfObjectToArray( $postsRepository->getFindFromRepository(array("id" => $postsList[0]['id'])) );
		
		
		$setupRecord = $setupManager->getSetupRecord();
		
		$postsAliasGetter = new postsAliasGetter($setupManager->getEntityManager());
		$postsAliasGetter->setRemotelink($setupRecord['remotelink']);
		
		$templateData = array_merge($postsAliasGetter->getPostsAlias(array("language" => $setupManager->getLanguageRepository()->getDefaultLanguage())), $setupRecord );
		$templateData['templatedir'] = 'frontend/projects/'.$templateData['frontendprojectdir'].'templates/'.$templateData['frontendTemplate'];
		$templateData['templatePartial'] = $templateData['templatedir'].'contents/detail.phtml'; // the controller must get this...
		if ( !$templateData['templatePartial'] ) {
			$templateData['templatePartial'] = $templateData['templatedir'].'homepage.phtml';
		}
		$templateData['imagedir'] = $templateData['templatedir'].'assets/images/';
		$templateData['cssdir']   = $templateData['templatedir'].'assets/css/';
 		$templateData['jsdir'] 	  = $templateData['templatedir'].'assets/js/';
 		$templateData['controllerResult'] = $postsDetail[0];
 		$templateData['categoryName'] = $categoryName;
 		$templateData['seo_title'] = '';
 		$templateData['seo_description'] = '';
 		$templateData['seo_keywords'] = '';
 		$templateData['languageAbbreviation'] = $setupManager->getLanguageRepository()->getLanguageAbbreviationFromDefaultLanguage();
 		
    	$this->layout($templateData['basiclayout']);
    	$this->layout()->setVariable("templateData", $templateData);
    	
    	return new ViewModel();
    }
    
    private function setSetupManager()
    {
    	
    }
}
