<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Posts;
use Setup\StringRequestDecoder;
use Setup\SetupManager;
use Posts\Model\PostsAliasGetter;
use Setup\EntitySerializer;

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
		
		// Given the category name, get the list of posts OR the post data to show details
		$stringRequestDecoder = new StringRequestDecoder();
		$categoryName = $stringRequestDecoder->denormalize( $this->params()->fromRoute('category') );
		
	
		$query = $setupManager->getEntityManager()->createQuery("SELECT p.id AS idpost, c.id AS idcat, po, p, co
			FROM Application\\Entity\\PostsOptions po, Application\\Entity\\Posts p, 
					Application\\Entity\\PostsRelations r, Application\\Entity\\Categories c, Application\\Entity\\CategoriesOptions co
			WHERE (po.posts = p.id AND p.id = r.posts AND c.id = r.category 
					AND co.category = c.id
			AND r.category = c.id AND r.channel = :channel
			AND co.language = :language AND po.language = :language ) 
		"); // AND co.name = 'Contatti' AND po.title = 'Contatti' 
			/*$query->setParameters(
					array(
						'channel' => $setupManager->getChannelId(),
						'language' => 1,
					)
			);*/
		$query->setParameter('channel', $setupManager->getChannelId());
		$query->setParameter('language', 1);

		//$query->setParameter('cname', $categoryName);
		$result = $query->getResult();
		
		$this->defaultFields = 'p.id AS idpost, c.id AS idcat, po.*, p.*, co.name,';
		$this->queryToBuild = $this->mainQuery = "SELECT SQL_CALC_FOUND_ROWS :queryFieldList ( SELECT COUNT(*) FROM posts p, relations r, attachments a WHERE ( p.id = r.rifidattachment and p.id = r.rifid and a.id = r.rifid ) AND typeofpost = 'attachment' ) AS totattachment FROM posts_options po, posts p, categories c, categories_options co, relations r WHERE ( po.rifpost = p.id AND p.id = r.rifid AND c.id = r.rifcat AND co.rifcategory=c.id AND r.rifcat = c.id ) AND r.rifchannel = :channel AND rifidattachment = '0' AND po.riflanguage = :language AND co.riflanguage = :language ";
		
		//var_dump($result);
		
		$postsDetail = array();
		$entitySerializer = new EntitySerializer($setupManager->getEntityManager());
		foreach ($result as &$result)
		{
			// TODO: check there is at least 1 object on $result[0] before using $entitySerializer->toArray!!!
			$postsDetail[] = $entitySerializer->toArray($result[0]);
		}
		//var_dump($postsDetail);
		
			
		
		$postsAliasGetter = new PostsAliasGetter($setupManager->getEntityManager());
		$postsAliasGetter->setRemotelink($setupRecord['remotelink']);
		
		//$templateData = array_merge($postsAliasGetter->getPostsAlias(array("language" => $setupManager->getLanguageRepository()->getDefaultLanguage())), $setupRecord );
		$templateData = $setupRecord;
		$templateData['templatedir'] = 'frontend/projects/'.$templateData['frontendprojectdir'].'templates/'.$templateData['frontendTemplate'];
		$templateData['templatePartial'] = $templateData['templatedir'].'contents/detail.phtml'; // the controller must get this...
		if ( !$templateData['templatePartial'] ) {
			$templateData['templatePartial'] = $templateData['templatedir'].'homepage.phtml';
		}
		$templateData['imagedir'] = $templateData['templatedir'].'assets/images/';
		$templateData['cssdir']   = $templateData['templatedir'].'assets/css/';
 		$templateData['jsdir'] 	  = $templateData['templatedir'].'assets/js/';
 		$templateData['controllerResult'] = $postsDetail[0];
 		$templateData['categoryName'] = $categoryName;
 		$templateData['seo_title'] = '';
 		$templateData['seo_description'] = '';
 		$templateData['seo_keywords'] = '';
 		$templateData['languageAbbreviation'] = $setupManager->getLanguageRepository()->getLanguageAbbreviationFromDefaultLanguage();
 		
    	$this->layout($templateData['basiclayout']);
    	$this->layout()->setVariable("templateData", $templateData);
    	
    	return new ViewModel();
    }
}
