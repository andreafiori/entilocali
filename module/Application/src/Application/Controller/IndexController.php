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

    	/* Preload */
    	$setupManager->getSetupManagerPreload()->setClassName( $setupManager->getTemplateDataSetter()->getTemplateData('preloader_frontend') );
    	$setupManager->getSetupManagerPreload()->setInstance($setupManager);
    	$setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray( $setupManager->getSetupManagerPreload()->setRecord() );
    	
		/* SINGLE POST SELECTION */
    		/**
    		 * TODO: 
    		 * 		if templatefile is set, get it as tempaltePartial; PAGING with adapter,
    		 * 		SEO tags if present, must be set
    		 * 		
    		 */
		if ($setupManager->getInput('categoryName')):
			$postsQueryBuilder = new PostsQueryBuilder();
			$postsQueryBuilder->setSetupManager($setupManager);
			$postsQueryBuilder->setQueryBasic();
			$postsQueryBuilder->setBasicBindParameters();
			$postsQueryBuilder->setLanguage($setupManager->getSetupManagerLanguages()->getLanguageId());
			$postsQueryBuilder->setCategoryName($setupManager->getInput('categoryName'));

			$postsDetail = $postsQueryBuilder->getSelectResult();
			if ($postsDetail[0]) {
				$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'contents/detail.phtml');
			} else {
				$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'homepage.phtml');
			}
		endif;

		/* TEMPLATE DATA */
		$setupManager->getTemplateDataSetter()->assignToTemplate('controllerResult', $postsDetail[0]);
		$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', $setupManager->getInput('categoryName') );
		
		/* SEO tags */
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_title', 		$setupManager->getTemplateDataSetter()->getTemplateData('sitename'));
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_description', $setupManager->getTemplateDataSetter()->getTemplateData('description'));
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_keywords', 	$setupManager->getTemplateDataSetter()->getTemplateData('keywords'));
		
	   	$this->layout( $setupManager->getTemplateDataSetter()->getTemplateData('basiclayout') );
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData());

    	return new ViewModel();
    }
}