<?php

namespace Backend\Form;

use Zend\Form\Form;
use Setup\SetupManager;

/**
 * PostsForm
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
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype', 'multipart/form-data');
		$this->setAttribute('class', 'form-horizontal');
		$this->setAttribute('role', 'form');
		
		$this->add(array(
				'name' => 'title',
				'id' => 'title',
				'type' => 'Text',
				'options' => array( 'label' => 'Titolo' ),
				'attributes' => array(
						'required' => 'required',
						'class' => 'form-control',
						'title' => 'Inserisci il titolo',
				)
		));

		$this->add(array(
				'name' => 'description',
				'id' => 'description',
				'type' => 'Textarea',
				'options' => array( 'label' => 'Descrizione' ),
				'attributes' => array(
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
				'options' => array(
						/* 'label' => 'Motori di ricerca', */
				),
		));
		
		$this->add(array(
				'name' => 'seotitle',
				'id' => 'seotitle',
				'type' => 'Text',
				'options' => array( 'label' => 'Titolo' ),
				'attributes' => array(
						'class' => 'form-control',
						'title' => 'Inserisci titolo per i motori di ricerca',
				)
		));
		
		$this->add(array(
				'name' => 'seodescription',
				'id' => 'seodescription',
				'type' => 'Textarea',
				'options' => array( 'label' => 'Descrizione' ),
				'attributes' => array(
						'class' => 'form-control',
						'title' => 'Inserisci descrizione per i motori di ricerca',
						'rows' => '5',
				)
		));
		
		$this->add(array(
				'name' => 'seokeywords',
				'id' => 'seokeywords',
				'type' => 'Textarea',
				'options' => array( 'label' => 'Parole chiave (separate da virgola)' ),
				'attributes' => array(
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
						'class' => 'btn btn-primary'
				),
		));
	}
}