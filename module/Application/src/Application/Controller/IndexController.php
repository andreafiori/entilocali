<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ServiceLocatorFactory;
use Posts\Model\PostsGetter;
use Application\Controller\Plugin\SetupManagerPlugin;

/**
 * Frontend main controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManagerPlugin = new SetupManagerPlugin();
    	$setupManager = $setupManagerPlugin->initialize(array(
    			'isbackend'				=> 0,
    			'controller' 			=> $this->params()->fromRoute('controller'),
    			'action'	 			=> $this->params()->fromRoute('action'),
    			'languageAbbreviation'  => strtolower( $this->params()->fromRoute('lang') ),
    			'categoryName' 			=> \Setup\StringRequestDecoder::slugify( $this->params()->fromRoute('category') ),
    			'title'		 			=> \Setup\StringRequestDecoder::slugify( $this->params()->fromRoute('title') ),
    	));

		/* SINGLE POST SELECTION (to move and refactor) */
		if ( $setupManager->getInput('categoryName') ):
			$postGetter = new PostsGetter($setupManager);
			$postGetter->setInput( $setupManager->getInput() );
		
			$postsDetail = $postGetter->getCompletePostRecord();
		endif;

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
				// $this->redirect()->toRoute('home');
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
	
	    /**
	     * @return SetupManager
	     */
	    private function getSetupManager()
	    {
	    	/* TODO: create FrontendSetupInitializerPlugin
	    	$bsip = new BackendSetupInitializerPlugin();
	    	$bsip->setRoute( $this->params()->fromRoute() );
	    	$bsip->initializeSetupManager();
	    	 */
	    	$setupManagerPlugin = new SetupManagerPlugin();
	    	$setupManager = $setupManagerPlugin->initialize(
	    			array(
	    				'isbackend'				=> 0,
			    		'controller' 			=> $this->params()->fromRoute('controller'),
			    		'action'	 			=> $this->params()->fromRoute('action'),
			    		'languageAbbreviation'  => strtolower( $this->params()->fromRoute('lang') ),
			    		'categoryName' 			=> \Setup\StringRequestDecoder::slugify( $this->params()->fromRoute('category') ),
			    		'title'		 			=> \Setup\StringRequestDecoder::slugify( $this->params()->fromRoute('title') ),
	    			)
	    	);
	    	return $setupManager;
	    }
}