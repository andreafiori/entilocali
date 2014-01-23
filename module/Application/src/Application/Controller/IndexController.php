<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ServiceLocatorFactory;
use Setup\SetupManagerWrapper;
use Setup\SetupManager;
use Posts\Model\PostsGetter;

/**
 * Frontend main controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
	private $setupManagerInput;
	
    public function indexAction()
    {
    	$this->setupManagerInput = array(
    				'isbackend'				=> 0,
    				'controller' 			=> $this->params()->fromRoute('controller'),
    				'action'	 			=> $this->params()->fromRoute('action'),
   					'languageAbbreviation'  => strtolower( $this->params()->fromRoute('lang') ),
    				'categoryName' 			=> \Setup\StringRequestDecoder::slugify( $this->params()->fromRoute('category') ),
    				'title'		 			=> \Setup\StringRequestDecoder::slugify( $this->params()->fromRoute('title') ),
    			);
    	$setupManagerWrapper = new SetupManagerWrapper( new SetupManager( $this->setupManagerInput ));
    	$setupManager = $setupManagerWrapper->initSetup();
    	
    	/* Preload */
    	$setupManager->getSetupManagerPreload()->setClassName( $setupManager->getTemplateDataSetter()->getTemplateData('preloader_class') );
    	$setupManager->getSetupManagerPreload()->setInstance($setupManager);
    	$setupManager->getTemplateDataSetter()->assignToTemplate('preloadrecord', $setupManager->getSetupManagerPreload()->setRecord() );
		
    	// TODO: the preload pattern overwrites the original SetupManager input!!!???
		$setupManager->setInput( $this->setupManagerInput );

		/* SINGLE POST SELECTION */
		if ( $setupManager->getInput('categoryName') ):
			$postGetter = new PostsGetter($setupManager);
		
			$postsDetail = $postGetter->getPost();
		endif;

		// TODO: refactor!!!
		if ( isset($postsDetail[0]) ) {
			if ( count($postsDetail) > 1 ) {
				$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'contents/list.phtml');
			} else {
				$postsDetail = $postsDetail[0];
				if ($postsDetail['templatefile']) {
					$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').$postsDetail['typeofpost'].'/'.$postsDetail['templatefile']);
				} else {
					$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').$postsDetail['typeofpost'].'/detail.phtml');
				}
			}
		} else {
			$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'homepage.phtml');
			
			/* Set redirect if it's not on home page? not always */
			if ( $setupManager->getInput('categoryName')!='' ) {
				//$this->redirect()->toRoute('home');
			}
		}

		/* TEMPLATE DATA */
		$setupManager->getTemplateDataSetter()->assignToTemplate('controllerResult', $postsDetail);
		$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', $setupManager->getInput('categoryName') );

		/* SEO Tags */
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_title', 		$setupManager->getTemplateDataSetter()->getTemplateData('sitename'));
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_description', $setupManager->getTemplateDataSetter()->getTemplateData('description'));
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_keywords', 	$setupManager->getTemplateDataSetter()->getTemplateData('keywords'));
		
	   	$this->layout( $setupManager->getTemplateDataSetter()->getTemplateData('basiclayout') );
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData());

    	return new ViewModel();
    }
}