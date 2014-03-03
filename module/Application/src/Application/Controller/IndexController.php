<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use ServiceLocatorFactory;
use Posts\Model\PostsGetter;
use Application\Controller\Plugin\FrontendSetupInitializerPlugin;
use Posts\Model\PostsFrontendTemplateGetter;

/**
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends FrontendControllerAbstract
{
    public function indexAction()
    {
    	$setupManager = $this->getSetupManager();
		
		/* SINGLE POST SELECTION; TODO: select data for all languages and set the switch link */
		if ( $setupManager->getInput('categoryName') ):
			$postGetter = new PostsGetter($setupManager);
			$postGetter->setInput( $setupManager->getInput() );

			$postsRecords = $postGetter->getCompletePostRecord();
		endif;
		
	
		$PostsFrontendTemplateGetter = new PostsFrontendTemplateGetter();
		$PostsFrontendTemplateGetter->setRecords($postsRecords);
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').$PostsFrontendTemplateGetter->setTemplate() );
		
		
		/* TEMPLATE DATA */
		$setupManager->getTemplateDataSetter()->assignToTemplate('controllerResult', $PostsFrontendTemplateGetter->getRecords() );
		$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', ucfirst(\Setup\StringRequestDecoder::deslugify($setupManager->getInput('categoryName'))) );

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
	    	$fsip = new FrontendSetupInitializerPlugin();
	    	$fsip->setRoute( $this->params()->fromRoute() );
	    	
	    	return $fsip->initializeSetupManager();
	    }
}
