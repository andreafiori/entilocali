<?php

namespace Posts\Controller;

use Backend\Controller\BackendController;
use Zend\View\Model\ViewModel;
use Posts\Model\PostsFormInputFilter;
use Posts\Model\PostsForm;

/**
 * Catch form posts requests
 * @author Andrea Fiori
 * @since  03 February 2014 
 */
class PostsFormPostsController extends BackendController
{
	/**
	 * 
	 * @return \Zend\View\Model\ViewModel
	 */
	public function addAction()
	{
		$setupManager = $this->generateSetupManagerFromInitializerPlugin();
		
		$response = $this->getResponse();
		$response->setStatusCode(200);
		$response->setContent("Add post under construction");
		
		$setupManager->getEntityManager()->getConnection()->beginTransaction();
		/*
		$setupManager->getEntityManager()->getConnection()->insert($tableName, $data);
		$setupManager->getEntityManager()->getConnection()->commit();
		$setupManager->getEntityManager()->getConnection()->rollBack();
		*/
		
		return new ViewModel ();
	}
	
	/**
	 * 
	 * @return \Zend\View\Model\ViewModel|Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>
	 */
	public function editAction()
	{
		if ( $this->getRequest()->isXmlHttpRequest() )
		{
			$setupManager = $this->generateSetupManagerFromInitializerPlugin();

			$request = $this->getRequest();
			$post = $request->getPost();
			$post = array_merge_recursive(
					$request->getPost()->toArray(),
					$request->getFiles()->toArray()
			);
			
			/* posts input filter */
			$postsFormInputFilter = new PostsFormInputFilter();
			
			/* posts form */
			$form = new PostsForm($setupManager);
			$form->setInputFilter($postsFormInputFilter->getInputFilter());
			$form->setData($post);
			
			if ($form->isValid()) {
				
			} else {
				
			}
						
			/* TODO: Upload Image (for gallery or blogs) */
			$fileFromTheForm = $this->params()->fromFiles('image');
				
			/* Update posts table */
			$updatePost = $setupManager->getEntityManager()->getConnection()->update("posts", array(
					"lastupdate" => date("Y-m-d H:i:s")
			), array("id" => $post -> id) );
				
			/* Update posts_options table */
			$updatePostOption = $setupManager->getEntityManager()->getConnection()->update("posts_options", array(
					"title" => $post->title,
					"seo_description" => $post->seoDescription,
					"seo_keywords" => $post->seoKeywords,
			), array("id" => $post->postoptionid) );
			
			$labels = $setupManager->getSetupManagerLanguagesLabels()->getLanguageLabels();
				
			$this->layout( $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'message.phtml' );
			$this->layout()->setVariable("messageTitle", "Dati aggiornati correttamente");
			$this->layout()->setVariable("messageText", "L'aggiornamento dati &egrave; stato completato con successo.");
			$this->layout()->setVariable("messageType", "success");
			$this->layout()->setVariable("showFormLink", 1);
			
			$view = new ViewModel();
			$view->setTemplate('backend/backend/index');
			return $view;

		} else {
			return $this->redirect()->toRoute('home');
		}
	}
	
}