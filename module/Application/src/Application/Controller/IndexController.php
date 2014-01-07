<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Posts\Model\PostsQueryBuilder;
use Posts\Model\PostsRecordsHelper;
use Languages\Model\LanguagesLabelsRepository;
use Config\Model\ConfigRepository;

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
    				'isbackend'	 => 0,
    				'controller' => $this->params()->fromRoute('controller'),
    				'action'	 => $this->params()->fromRoute('action'),
   					'languageAbbreviation' => strtolower( $this->params()->fromRoute('lang') )
    			)
    	);
    	$setupManager->setChannelId();
    	$setupManager->setEntityManager( $this->getServiceLocator()->get('entityManagerService') );
    	$setupManager->setLanguagesSetup();
    	$setupManager->setDefaultLanguage();
    	$setupManager->setLanguageIdFromDefaultLanguage();
    	$setupManager->setLanguageAbbreviationFromDefaultLanguage();
    	$setupManager->setLanguagesLabelsRepository( new LanguagesLabelsRepository($setupManager->getEntityManager()) );
    	$setupManager->setLanguagesLabels();
    	$setupManager->setConfigRepository( new ConfigRepository($setupManager->getEntityManager()) );
    	$setupManager->setConfigurations();
    	
		$configRecord = $setupManager->getConfigRepository()->getConfigRecord();

		$categoryName = \Setup\StringRequestDecoder::deSlugify( $this->params()->fromRoute('category') );
		
		// SINGLE POST SELECTION
		if ($categoryName):
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($setupManager);

		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		
		$postsQueryBuilder->setCategoryName($categoryName);
		$postsDetail = $postsQueryBuilder->getSelectResult();
		endif;
		// END SINGLE POST SELECTION
		
		
		// ALIAS SELECTION
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($setupManager);
		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		$postsQueryBuilder->setAliasNotNull();

		$result = $postsQueryBuilder->getSelectResult();

		$postsRecordsHelper = new PostsRecordsHelper($result);
		$postsRecordsHelper->setRemotelinkWeb($configRecord['remotelinkWeb']);
		$postsRecordsHelper->setSetupManager($setupManager);
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
 		$templateData['seo_title'] = '';
 		$templateData['seo_description'] = '';
 		$templateData['seo_keywords'] = '';
 		$templateData['languageAbbreviation'] = $setupManager->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage();

    	$this->layout($templateData['basiclayout']);
    	$this->layout()->setVariable("templateData", $templateData);

    	return new ViewModel();
    }   
    /*
    public function contactsAction()
    {
    	echo "send message!";
    }
    */
}
