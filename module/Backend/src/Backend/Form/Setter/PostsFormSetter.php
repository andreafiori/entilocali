<?php

namespace Backend\Form\Setter;

use Backend\Model\FormSetterAbstract;
use Posts\Model\PostsGetter;

/**
 * TODO: 
 * 		check if you can show the form...
 * @author Andrea Fiori
 * @since  26 January 2014
 */
class PostsFormSetter extends FormSetterAbstract
{
	protected $zendFormObjectClassName = '\Posts\Model\PostsForm';
	
	/**
	 * set single record using PostsGetter
	 */
	public function setRecord($id)
	{
		if ( is_numeric($id) ) {
			$postsFormGetter = new PostsGetter($this->setupManager);
			$postsFormGetter->setInput( array('id' => $id) );

			$this->record = $postsFormGetter->getPostsRecordOnly();
		}

		return $this->record;
	}
	
	public function setAction()
	{
		if ( $this->getRecord() ) {
			$this->action = "PostsFormPosts/edit/";
		} else {
			$this->action = "PostsFormPosts/add/";
		}
		
		return $this->action;
	}

	/**
	 * TODO: set form title basic on typeofpost
	 */
	public function setTitle()
	{
		$labels = $this->setupManager->getSetupManagerLanguagesLabels();
		$record = $this->getRecord();
		if ($record) {
			$this->title = $record[0]['title'];
		} else {

		}
		
		return $this->title;
	}

	public function setDescription()
	{
		$labels = $this->setupManager->getSetupManagerLanguagesLabels();
		
		//$this->formDescription = $labels[''];
	}
}