<?php

namespace ModelModule\Model\Posts;

use Zend\Form\Form;

class PostsCategoriesForm extends Form
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
                                    'title' => 'Inserisci nome categoria',
                                    'id' => 'name',
                                    'maxlength' => 255,
                    )
        ));
        
        $this->add(array(
                        'name' => 'description',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Descrizione' ),
                        'attributes' => array(
                                        'title'     => 'Inserisci descrizione',
                                        'id'        => 'nome',
                                        'maxlength' => 255,
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
    }
}