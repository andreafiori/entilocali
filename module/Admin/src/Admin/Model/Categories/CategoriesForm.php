<?php

namespace Admin\Model\Categories;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  09 June 2014
 */
class CategoriesForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('formData');
        
        $this->add(array(
                    'name' => 'name',
                    'type' => 'Text',
                    'options' => array( 'label' => '* Nome' ),
                    'attributes' => array(
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'title' => 'Inserisci nome categoria',
                                    'id' => 'name',
                    )
        ));
        
        $this->add(array(
                        'name' => 'description',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Descrizione' ),
                        'attributes' => array(
                                        'class' => 'form-control',
                                        'title' => 'Inserisci descrizione',
                                        'id'    => 'nome',
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
                                        'rows' => 5,
                        ),
        ));

        $this->add(array(
                        'name' => 'seoKeywords',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Parole chiave (separate da virgola)' ),
                        'attributes' => array(
                                        'id'    => 'seoKeywords',
                                        'class' => 'form-control',
                                        'title' => 'Parole chiave per i motori di ricerca',
                                        'rows'  => '5',
                        )
        ));
        
        $this->add(array(
                        'name' => 'moduleId',
                        'type' => 'Hidden',
                        'attributes' => array( 'id' => 'moduleId', 'class' => 'hiddenField' )
        ));
        
        $this->add(array(
                        'name' => 'id',
                        'type' => 'Hidden',
                        'attributes' => array( 'id' => 'id', 'class' => 'hiddenField' )
        ));
        
        /*
         * TODO: parentId sub categories selection...
         * 
        $this->add(array(
                    'name' => 'accesskey',
                    'type' => 'Text',
                    'options' => array( 'label' => 'Accesskey' ),
                    'attributes' => array(
                                    'class' => 'form-control',
                                    'title' => 'Inserisci tasto shortcut da tastiera',
                                    'maxlength' => '3',
                                    'id' => 'accesskey',
                    )
        ));
        */
    }
}