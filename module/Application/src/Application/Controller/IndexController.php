<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use ServiceLocatorFactory;
use Posts\Model\PostsGetter;
use Posts\Model\PostsFrontendTemplateGetter;

/**
 * TODO: 
 * 		select data for all languages and set the switch link for SINGLE POST SELECTION
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends FrontendControllerAbstract
{
    public function indexAction()
    {
    	$setupManager = $this->generateSetupManagerFromInitializerPlugin();
		
		if ( $setupManager->getInput('categoryName') ):
			$postGetter = new PostsGetter($setupManager);
			$postGetter->setInput( $setupManager->getInput() );

			$postsRecords = $postGetter->getCompletePostRecord();
		endif;
		
	
		$PostsFrontendTemplateGetter = new PostsFrontendTemplateGetter();
		$PostsFrontendTemplateGetter->setRecords($postsRecords);
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').$PostsFrontendTemplateGetter->setTemplate() );
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('controllerResult', $PostsFrontendTemplateGetter->getRecords() );
		$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', ucfirst(\Setup\StringRequestDecoder::deslugify($setupManager->getInput('categoryName'))) );
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_title', 		$setupManager->getTemplateDataSetter()->getTemplateData('sitename'));
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_description', $setupManager->getTemplateDataSetter()->getTemplateData('description'));
		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_keywords', 	$setupManager->getTemplateDataSetter()->getTemplateData('keywords'));

	   	$this->layout( $setupManager->getTemplateDataSetter()->getTemplateData('basiclayout') );
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData());

    	return new ViewModel();
    }
}
