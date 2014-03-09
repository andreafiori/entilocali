<?php

namespace Backend\Form\Setter;

use Backend\Model\FormSetterAbstract;
use Posts\Model\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  26 January 2014
 */
class PostsFormSetter extends FormSetterAbstract
{
	protected $zendFormObjectClassName = '\Posts\Model\PostsForm';
	
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

	public function setTitle($input = null)
	{
		$labels = $this->setupManager->getSetupManagerLanguagesLabels();
		$record = $this->getRecord();
		if ($record) {
			$this->title = $record[0]['title'];
		} else {
			
			if (!is_array($input)) {
				return false;
			}
			
			switch($input['typeofpost']) {
				case("content"):
					$this->title = "Nuova pagina";
				break;
				
				case("blog"):
					$this->title = "Nuovo post";
				break;
				
				case("photo"):
					$this->title = "Nuova foto";
				break;
			}
		}
		
		return $this->title;
	}
	
	public function setDescription($input=null)
	{
		$labels = $this->setupManager->getSetupManagerLanguagesLabels();
		
		if ( $this->getRecord() ) {
			$this->description = 'Modifica i dati e conferma premendo il pulsante in fondo alla pagina';
		} else {
			
			if (!is_array($input)) {
				return false;
			}
			
			switch($input['typeofpost']) {
				case("content"):
					$this->description = 'Modifica i dati e conferma premendo il pulsante in fondo alla pagina';
				break;
				
				case("blog"):
					$this->description = 'Modifica i dati e conferma premendo il pulsante in fondo alla pagina';
				break;
				
				case("photo"):
					$this->description = 'Modifica i dati e conferma premendo il pulsante in fondo alla pagina';
				break;
			}
		}
		
		return $this->description;
	}
}