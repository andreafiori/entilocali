<?php

namespace Posts\Model;

use Backend\Form\ZendFormSetterAbstract;

/**
 * TODO:
		image blog: if no record: check $_GET typeofpost
		image blog: if record OK: check if is isSet typeofpost
		sub-contents
 * @author Andrea Fiori
 * @since  20 January 2014
 */
class PostsForm extends ZendFormSetterAbstract
{
	private $typeofpostsImageAllowedTypes = array('blog', 'photo');
	
	public function addFormFields()
	{
		$dictionary = $this->getLanguageLabels();
		
		/*
		if ($this->getRecod('typeofpost') == 'blog' or $this->getRecod('typeofpost') == 'photo') {
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
		}
		*/
		
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
						'id'		=> 'description',
						'required' 	=> 'required',
						'class' 	=> 'ckeditor',
				)
		));

		/* Category select */
		if ( !$this->getInputRecord() ) {
			$this->add(array(
					'name'    => 'category',
					'type'    => 'Zend\Form\Element\Select',
					'options' => array(
							'label'         => 'Categoria',
							'value_options' => $this->getOptionsForSelect(),
							'empty_option'  => '-- Seleziona --'
					),
					"attributes" => array(
							'class'		=> 'form-control',
							'required'  => 'required',
							'id' 		=> 'category',
							'title' => 'Seleziona la categoria',
					)
			));			
		}

		$this->add(array(
				'type' => 'Application\Form\Element\PlainText',
				'name' => 'start_date',
				'attributes' => array(
						'id' => 'searchEngines',
						'value' => '<h3>'.$dictionary['ADMIN_SEARCH_ENGINES'].'</h3>',
				),
		));

		$this->add(array(
				'name' => 'seoDescription',
				'type' => 'Textarea',
				'options' => array( 'label' => 'Descrizione' ),
				'attributes' => array(
						'id' => 'seoDescription',
						'class' => 'form-control',
						'title' => $dictionary['ADMIN_DESCRIPTION'],
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
						'title' => $dictionary['ADMIN_SEOKEYWORDS_LABEL'],
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
	
	public function getOptionsForSelect()
	{
		$postsGetter = new PostsGetter( $this->getSetupManager() );
		$postsGetter->getQueryBuilder()->setDefaultFieldsSelect("DISTINCT(co.name) AS name, c.id AS id");
		$postsGetter->setInput( array("typeofpost"=>"content", "orderBy" => "co.name") );
		
		$result = $postsGetter->getCompletePostRecord();
		
		$selectData = array();
		if ($result) {
			foreach ($result as $res) {
				$selectData[$res['id']] = $res['name'];
			}
		}
		
		return $selectData;
	}
}