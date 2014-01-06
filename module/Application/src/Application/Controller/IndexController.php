<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Setup\StringRequestDecoder;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Posts\Model\PostsQueryBuilder;

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
    				'isbackend' => 0,
    				'controller' => $this->params()->fromRoute('controller'),
    				'action'	 => $this->params()->fromRoute('action'),
   					'languageAbbreviation' => strtolower( $this->params()->fromRoute('lang') )
    			)
    	);
    	$setupManager->setChannelId();
    	$setupManager->setEntityManager( $this->getServiceLocator()->get('entityManagerService') );
		$setupRecord = $setupManager->generateSetupRecord();
		
		$stringRequestDecoder = new StringRequestDecoder();
		$categoryName = $stringRequestDecoder->denormalize( $this->params()->fromRoute('category') );

		
		// SINGLE POST SELECTION
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($setupManager);

		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		
		$postsQueryBuilder->setCategoryName($categoryName);
		$postsDetail = $postsQueryBuilder->getSelectResult();
		// END SINGLE POST SELECTION
		
		
		// ALIAS SELECTION
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($setupManager);
		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		$postsQueryBuilder->setAliasNotNull();

		$result = $postsQueryBuilder->getSelectResult();
		
		$postsAlias = array();
		foreach($result as &$result)
		{
			$result['linkDetails'] = $result['seoUrl'];
			$postsAlias[ $result['alias'] ] = $result;
		}
		// END ALIAS SELECTION
		
		
		// GET TEMPLATE DATA
		$templateData = array_merge(
				$postsAlias, 
				$setupRecord 
		);

		$templateData['basePath'] = $setupManager->getSetupRecord('remotelinkWeb');
		$templateData['templatedir'] = 'frontend/projects/'.$templateData['frontendprojectdir'].'templates/'.$templateData['frontendTemplate'];
		$templateData['templatePartial'] = $templateData['templatedir'].'contents/detail.phtml'; // the controller must get this...
		if ( !$templateData['templatePartial'] ) {
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
 		$templateData['languageAbbreviation'] = $setupManager->getLanguage()->getLanguageAbbreviationFromDefaultLanguage();

    	$this->layout($templateData['basiclayout']);
    	$this->layout()->setVariable("templateData", $templateData);

    	return new ViewModel();
    }
}
