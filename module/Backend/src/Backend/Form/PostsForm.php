<?php

namespace Backend\Form;

use Zend\Form\Form;
use Setup\SetupManager;


abstract class ZendFormHelper
{
	protected $formAction;
	
	protected $record;
	
	protected $route;
	
	protected $setupManager;
	
	public function __construct($name='formData')
	{
		parent::__construct($name);
	}
	
	public function setSetupManager(SetupManager $setupManager)
	{
		$this->setupManager->getSetupManagerLanguagesLabels();
	}
	
	public function setFormAction($action)
	{
		$this->formAction = $action;
	}
	
	public function setRoute($route)
	{
		$this->route = $route;
	}

	public function setRecord($record)
	{
		$this->record = $record;
	}
	
	abstract public function addFormElements();
}

/**
 * PostsForm
 * TODO:
 * 		set record 
 * 		set form name
 * 		set action
 * 		set data into zend\form object
 * 		set route
 * 		add form elements
 * 		set form data (hydrator)
 * 
 * @author Andrea Fiori
 * @since  20 January 2014
 */
class PostsForm extends Form
{
	private $setupManager;

	public function __construct(SetupManager $setupManager)
	{
		parent::__construct('formdata');
		
		$labels = $setupManager->getSetupManagerLanguagesLabels();

		$this->add(array(
				'name' => 'title',
				'type' => 'Text',
				'options' => array( 'label' => 'Titolo' ),
				'attributes' => array(
						'required' => 'required',
						'class' => 'form-control',
						'title' => 'Inserisci il titolo',
						'id' => 'title',
				)
		));

		$this->add(array(
				'name' => 'description',
				'type' => 'Textarea',
				'options' => array( 'label' => 'Descrizione' ),
				'attributes' => array(
						'id' => 'description',
						'required' => 'required',
						'class' => 'ckeditor',
				)
		));
		
		$this->add(array(
				'type' => 'Application\Form\Element\PlainText',
				'name' => 'start_date',
				'attributes' => array(
						'id' => 'searchEngines',
						'value' => '<h3>Motori di ricerca</h3>',
				),
		));

		$this->add(array(
				'name' => 'seoDescription',
				'type' => 'Textarea',
				'options' => array( 'label' => 'Descrizione' ),
				'attributes' => array(
						'id' => 'seoDescription',
						'class' => 'form-control',
						'title' => 'Inserisci descrizione per i motori di ricerca',
						'rows' => '5',
				)
		));
		
		$this->add(array(
				'name' => 'seoKeywords',				
				'type' => 'Textarea',
				'options' => array( 'label' => 'Parole chiave (separate da virgola)' ),
				'attributes' => array(
						'id' => 'seoKeywords',
						'class' => 'form-control',
						'title' => 'Parole chiave per i motori di ricerca',
						'rows' => '5',
				)
		));

		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Conferma',
						'id' => 'submitbutton',
						'class' => 'btn btn-primary',
						'onclick' => "javascript: $('#formcontainer').hide()"
				),
		));
	}
}