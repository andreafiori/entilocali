<?php

namespace Backend\Form\Setter;

use Backend\Model\FormSetterAbstract;
use Posts\Model\PostsGetter;

/**
 * PostsFormSetter
 * @author Andrea Fiori
 * @since  26 January 2014
 */
class PostsFormSetter extends FormSetterAbstract
{
	protected $zendFormObjectClassName = 'PostsForm';
	
	public function setRecord($id)
	{
		if ( !is_numeric($id) ) {
			return false;
		}

		$postsFormGetter = new PostsGetter($this->setupManager);
		$postsFormGetter->setInput( array('id' => $id) );

		$this->record = $postsFormGetter->getPostsRecordOnly();
	}

	public function setTitle()
	{
		$labels = $this->setupManager->getSetupManagerLanguagesLabels();
		$record = $this->getRecord();
		if ($record) {
			$this->title = $record[0]['title'];
		} else {
			// TODO: set form title basic on typeofpost
		}
		
		return $this->title;
	}

	public function setDescription()
	{
		$labels = $this->setupManager->getSetupManagerLanguagesLabels();

		$this->formDescription = '';
	}
}