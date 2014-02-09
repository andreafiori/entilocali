<?php

namespace Posts\Model;

use Zend\Form\Form;
use Setup\SetupManager;

/**
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
		
		//if (=='blog' or =='photo'):
		$this->add(array(
				'name' => 'image',
				'type' => 'Zend\Form\Element\File',
				'options' => array( 'label' => 'Immagine' ),
				'attributes' => array(
						'class' => 'form-control',
						'title' => 'Inserisci file',
						'id' => 'image',
				)
		));
		//endif;
		
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
		    'type' => 'Zend\Form\Element\Hidden',
		    'name' => 'postid',
		    'attributes' => array("class"=>'hiddenField')
		));
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Hidden',
				'name' => 'postoptionid',
				'attributes' => array("class"=>'hiddenField')
		));
		
		/* Submit button can be moved into the global form view */
		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Conferma',
						'id' => 'submitbutton',
						'class' => 'btn btn-primary',
						/* 'onclick' => "javascript: $('#formcontainer').hide()" */
				),
		));
	}
}