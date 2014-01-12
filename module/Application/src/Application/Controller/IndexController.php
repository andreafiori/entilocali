<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ServiceLocatorFactory;
use Posts\Model\PostsQueryBuilder;
use Posts\Model\PostsRecordsHelper;
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
    	
		/**
		 * TODO: move this on a home page \ frontend model to load before all (inside setup manage!?)
		 * 		 check posts to load
		 * 		 get different template \ layout for different posts types (photo, blog etc.)
		 * 		 try to set up other modules routing for albo
		 */
		// ALIAS SELECTION given the controller name load data you want to load ALWAYS on the app
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($setupManager);
		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		$postsQueryBuilder->setLanguage($setupManager->getSetupManagerLanguages()->getLanguageId());
		$postsQueryBuilder->setAliasNotNull();
		
		$postsRecordsHelper = new PostsRecordsHelper($postsQueryBuilder->getSelectResult());
		$postsRecordsHelper->setSetupManager($setupManager);
		$postsRecordsHelper->setRemotelinkWeb($setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord('remotelinkWeb'));
		$postsRecordsHelper->setAdditionalArrayElements();
		$postsAlias = $postsRecordsHelper->sortPostsByAlias(true);
		// END ALIAS SELECTION
		
		/*
		$categoriesQueryBuilder = new CategoriesQueryBuilder($setupManager->getEntityManager());
		$categoriesQueryBuilder->setSetupManager($setupManager);
		$categoriesQueryBuilder->setParentId();
		var_dump( $categoriesQueryBuilder->getSelectResult() );
		*/
		
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

		// SET TEMPLATE DATA... input: previous controller result, configRecord, controller result
		$setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray($postsAlias);
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('projectdir', 'frontend/projects/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendprojectdir'));
		$setupManager->getTemplateDataSetter()->assignToTemplate('frontendtemplate', $setupManager->getTemplateDataSetter()->getTemplateData('frontendtemplate') ? $setupManager->getTemplateDataSetter()->getTemplateData('frontendtemplate') : 'default/');
		$setupManager->getTemplateDataSetter()->assignToTemplate('basiclayout', $setupManager->getTemplateDataSetter()->getTemplateData('projectdir').'templates/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendtemplate').'layout.phtml');
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('languageAllAvailable', $setupManager->getSetupManagerLanguages()->getLanguageSetup()->getAllAvailableLanguages());
		$setupManager->getTemplateDataSetter()->assignToTemplate('languageDefault', $setupManager->getSetupManagerLanguages()->getLanguageSetup()->getDefaultLanguage());
		$setupManager->getTemplateDataSetter()->assignToTemplate('languageLabels', $setupManager->getSetupManagerLanguages()->getLanguageLabels());
		$setupManager->getTemplateDataSetter()->assignToTemplate('languageAbbreviation', $setupManager->getSetupManagerLanguages()->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage());
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('basePath', $setupManager->getTemplateDataSetter()->getTemplateData('remotelinkWeb') );
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatedir', 'frontend/projects/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendprojectdir').'templates/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendTemplate'));

		// Refactor the partial template inclusion...
		if ($postsDetail[0]) {
			$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'contents/detail.phtml');
		} else {
			$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'homepage.phtml');
		}
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('imagedir', $setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/images/');
		$setupManager->getTemplateDataSetter()->assignToTemplate('cssdir', $setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/css/');
		$setupManager->getTemplateDataSetter()->assignToTemplate('jsdir', $setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/js/');
		
		// Record data from the controller: to revisit
 		$setupManager->getTemplateDataSetter()->assignToTemplate('controllerResult', $postsDetail[0]);
 		$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', $setupManager->getInput('categoryName'));
 		
 		// SEO if not set from main controller...
 		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_title', $setupManager->getTemplateDataSetter()->getTemplateData('sitename'));
 		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_description', $setupManager->getTemplateDataSetter()->getTemplateData('description'));
 		$setupManager->getTemplateDataSetter()->assignToTemplate('seo_keywords', $setupManager->getTemplateDataSetter()->getTemplateData('keywords'));
 		 		
    	$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('basiclayout')); 
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData());

    	return new ViewModel();
    }
}