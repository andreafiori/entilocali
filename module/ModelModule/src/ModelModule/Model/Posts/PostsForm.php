<?php

namespace ModelModule\Model\Posts;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 May 2014
 */
class PostsForm extends Form
{
    public function addUploadImage()
    {
        $this->add( $this->recoverUploadImage() );
    }

    public function addUploadImageRequired()
    {
        $element = $this->recoverUploadImage();

        $element['attributes']['required'] = 'required';

        $this->add( $element );
    }

        private function recoverUploadImage()
        {
            return array(
                'name' => 'image',
                'type' => 'Zend\Form\Element\File',
                'options' => array('label' => 'Immagine'),
                'attributes' => array(
                    'title' => 'Inserisci file',
                    'id'    => 'image',
                )
            );
        }

    public function addMainFields()
    {
        $this->add(array(
                        'name' => 'title',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Titolo' ),
                        'attributes' => array(
                                        'required'      => 'required',
                                        'placeholder'   => 'Inserisci il titolo',
                                        'title'         => 'Inserisci il titolo',
                                        'id'            => 'title',
                        )
        ));
        
        $this->add(array(
                        'name' => 'subtitle',
                        'type' => 'Text',
                        'options'    => array( 'label' => 'Sotto titolo' ),
                        'attributes' => array(
                                        'title'         => 'Inserisci il sotto titolo',
                                        'placeholder'   => 'Inserisci il sotto titolo',
                                        'id'            => 'subtitle',
                        )
        ));

        $this->add(array(
                        'name' => 'description',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Descrizione' ),
                        'attributes' => array(
                                        'id'        => 'description',
                                        'required'  => 'required',
                                        'class'     => 'wysiwyg',
                        )
        ));
        
        $this->add(array(
                        'type' => 'DateTime',
                        'name' => 'expireDate',
                        'options' => array(
                                'label'     => 'Scadenza',
                                'format'    => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'style' => 'width: 22%',
                                'id'    => 'expireDate'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'status',
                        'options' => array(
                               'label' => '* Stato',
                                'empty_option' => 'Seleziona',
                                'value_options' => array(
                                       'attivo'   => 'Attivo',
                                       'nascosto' => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona stato',
                                'id'    => 'status'
                        )
        ));
  
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'postid',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'type',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'moduleId',
                        'attributes' => array("class"=>'hiddenField')
        ));
    }

    /**
     * @param array $values
     */
    public function addCategory(array $values)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'categories',
            'options' => array(
                'label' => '* Categorie',
                'value_options' => $values,
            ),
            'attributes' => array(
                'id'    => 'categories',
                'title' => 'Seleziona almeno una categoria',
                'required' => 'required'
            )
        ));
    }
    
    /**
     * SEO Fields
     */
    public function addSEO()
    {
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
                                        'id'    => 'seoDescription',
                                        'title' => 'Inserisci descrizione per i motori di ricerca',
                                        'rows'  => 5,
                        ),
        ));

        $this->add(array(
                        'name' => 'seoKeywords',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Parole chiave (separate da virgola)' ),
                        'attributes' => array(
                                        'id'    => 'seoKeywords',
                                        'title' => 'Parole chiave per i motori di ricerca',
                                        'rows'  => 5,
                        )
        ));
    }
}
