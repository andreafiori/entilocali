<?php

namespace Admin\Model\Posts;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 May 2014
 */
class PostsForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('formData');
    }
    
    public function addMainFields()
    {
        /*
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
        */

        $this->add(array(
                        'name' => 'titolo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Titolo' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'title' => 'Inserisci il titolo',
                                        'id' => 'titolo',
                        )
        ));

        $this->add(array(
                        'name' => 'descrizione',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Descrizione' ),
                        'attributes' => array(
                                        'id' => 'descrizione',
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

        $this->add(array(
                        'name' => 'submit',
                        'attributes' => array(
                                        'type'  => 'submit',
                                        'value' => 'Conferma',
                                        'id' => 'submitbutton',
                                        'class' => 'btn btn-primary',
                                        // 'onclick' => "javascript: $('#formcontainer').hide()"
                        ),
        ));
    }
}
