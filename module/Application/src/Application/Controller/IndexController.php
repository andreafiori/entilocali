<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ServiceLocatorFactory;
use Posts\Model\PostsQueryBuilder;
use Setup\SetupManagerWrapper;
use Setup\SetupManager;

/**
 * Frontend main controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManagerWrapper = new SetupManagerWrapper( new SetupManager(
    			array(
    				'isbackend'				=> 0,
    				'controller' 			=> $this->params()->fromRoute('controller'),
    				'action'	 			=> $this->params()->fromRoute('action'),
   					'languageAbbreviation'  => strtolower( $this->params()->fromRoute('lang') ),
    				'categoryName' 			=> \Setup\StringRequestDecoder::deSlugify( $this->params()->fromRoute('category') ),
    				'title'		 			=> \Setup\StringRequestDecoder::deSlugify( $this->params()->fromRoute('title') )
    			)
    	));
    	$setupManager = $setupManagerWrapper->initSetup();
    	    	
    	/* Preload object (ALIASes, to refactor), TODO: cache loaded records! */
    	$setupManager->getSetupManagerPreload()->setClassName( $setupManager->getTemplateDataSetter()->getTemplateData('preloader_frontend') );
    	$instance = $setupManager->getSetupManagerPreload()->getClassName();
    	$instance = new $instance($setupManager);
    	
    	$setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray($instance->setRecord());
    	
    	
		// SINGLE POST SELECTION: given category and\or title, get the post! title only is not allowed!?
		if ($setupManager->getInput('categoryName')):
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($setupManager);
		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		$postsQueryBuilder->setLanguage($setupManager->getSetupManagerLanguages()->getLanguageId());
		$postsQueryBuilder->setCategoryName($setupManager->getInput('categoryName'));

		$postsDetail = $postsQueryBuilder->getSelectResult();
		endif;
		
		// END SINGLE POST SELECTION

		/* TEMPLATE DATA
		if (is_array($postsAlias)) {
			$setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray($postsAlias);
		}
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('basePath', $setupManager->getTemplateDataSetter()->getTemplateData('remotelinkWeb') );
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatedir', 'frontend/projects/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendprojectdir').'templates/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendTemplate'));	
		*/
		
		/*
		
		//TODO: get main data from the controller and THEN:
		
		if ($controllerResult[0]) {
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template').'contents/detail.phtml');
		} else {
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template').'homepage.phtml');
		}
		
		$templateData['controllerResult'] = $controllerResult;
		$templateData['categoryName'] = $this->setupManager->getInput('categoryName');
		
		
		... if not set get seo options from config ...
		
		$this->setupManager->getTemplateDataSetter()->assignToTemplate('seo_title', $this->setupManager->getTemplateDataSetter()->getTemplateData('sitename'));
		$this->setupManager->getTemplateDataSetter()->assignToTemplate('seo_description', $this->setupManager->getTemplateDataSetter()->getTemplateData('description'));
		$this->setupManager->getTemplateDataSetter()->assignToTemplate('seo_keywords', $this->setupManager->getTemplateDataSetter()->getTemplateData('keywords'));
		
		*/
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', 'frontend/projects/fossobandito/templates/default/homepage.phtml');
		
    	$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('basiclayout'));
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData());

    	return new ViewModel();
    }
}