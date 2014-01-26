<?php

namespace Posts\Model;

use Backend\Model\FormSetterAbstract;

/**
 * PostsFormSetter
 * @author Andrea Fiori
 * @since  26 January 2014
 */
class PostsFormSetter extends FormSetterAbstract
{
	/**
	 * TODO: use the postsFormGetter to get posts record for the form
	 */
	public function setRecord($id)
	{
		$this->record = $id;
	}

	public function setFormTitle()
	{
		$labels = $this->setupManager->getSetupManagerLanguagesLabels();

		$this->formTitle = '';
	}

	public function setFormDescription()
	{
		$labels = $this->setupManager->getSetupManagerLanguagesLabels();

		$this->formDescription = '';
	}
}