<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Posts\Model\PostsQueryBuilder;
use Posts\Model\PostsRecordsHelper;
use Setup\SetupManagerWrapper;

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
    				'isbackend'	 => 0,
    				'controller' => $this->params()->fromRoute('controller'),
    				'action'	 => $this->params()->fromRoute('action'),
   					'languageAbbreviation' => strtolower( $this->params()->fromRoute('lang') )
    			)
    	));
    	$setupManager = $setupManagerWrapper->initSetup();

		$configRecord = $setupManager->getConfigRepository()->getConfigRecord();
		$categoryName = \Setup\StringRequestDecoder::deSlugify( $this->params()->fromRoute('category') );	


		// SINGLE POST SELECTION
		if ($categoryName):
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($setupManager);
		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		$postsQueryBuilder->setLanguage();
		$postsQueryBuilder->setCategoryName($categoryName);
		$postsDetail = $postsQueryBuilder->getSelectResult();
		endif;
		// END SINGLE POST SELECTION
		
	
		// ALIAS SELECTION
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($setupManager);
		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		$postsQueryBuilder->setLanguage();
		$postsQueryBuilder->setAliasNotNull();

		$postsRecordsHelper = new PostsRecordsHelper($postsQueryBuilder->getSelectResult());
		$postsRecordsHelper->setSetupManager($setupManager);
		$postsRecordsHelper->setRemotelinkWeb($configRecord['remotelinkWeb']);
		$postsRecordsHelper->setAdditionalArrayElements();
		$postsAlias = $postsRecordsHelper->sortPostsByAlias();
		// END ALIAS SELECTION
		
		
		// SET TEMPLATE DATA. Some data can be set before this point...
		$templateData = array_merge($postsAlias, $configRecord);

		$templateData['projectdir'] = 'frontend/projects/'.$templateData['frontendprojectdir'];
		$templateData['frontendtemplate'] = $templateData['frontendtemplate'] ? $templateData['frontendtemplate'] : 'default/';
		$templateData['basiclayout'] = $templateData['projectdir'].'templates/'.$templateData['frontendtemplate'].'layout.phtml';
		
		$templateData['languageAllAvailable'] = $setupManager->getLanguageSetup()->getAllAvailableLanguages();
		$templateData['languageDefault'] = $setupManager->getDefaultLanguage();
		$templateData['languageLabels'] = $setupManager->getLanguageLabels();
		
		$templateData['basePath'] = $templateData['remotelinkWeb'];
		$templateData['templatedir'] = 'frontend/projects/'.$templateData['frontendprojectdir'].'templates/'.$templateData['frontendTemplate'];

		if ($postsDetail[0]) {
			$templateData['templatePartial'] = $templateData['templatedir'].'contents/detail.phtml';
		} else {
			$templateData['templatePartial'] = $templateData['templatedir'].'homepage.phtml';
		}
		
		$templateData['imagedir'] = $templateData['templatedir'].'assets/images/';
		$templateData['cssdir']   = $templateData['templatedir'].'assets/css/';
 		$templateData['jsdir'] 	  = $templateData['templatedir'].'assets/js/';
 		$templateData['controllerResult'] = $postsDetail[0]; // record data from the controller
 		$templateData['categoryName'] = $categoryName;
 		$templateData['seo_title'] = $templateData['sitename'];
 		$templateData['seo_description'] = $templateData['description'];
 		$templateData['seo_keywords'] = $templateData['keywords'];
 		$templateData['languageAbbreviation'] = $setupManager->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage();

    	$this->layout($templateData['basiclayout']);
    	$this->layout()->setVariable("templateData", $templateData);

    	return new ViewModel();
    }
}