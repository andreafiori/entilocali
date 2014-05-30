<?php

namespace Admin\Model\Posts;

use Zend\Form\Form;

/**
 * Posts Form Admin
 * 
 * @author Andrea Fiori
 * @since  17 May 2014
 */
class PostsForm extends Form
{
    private $input;
    
    public function __construct($name = null)
    {
        parent::__construct('formData');
    }
    
    public function setInput(array $input)
    {
        $this->input = $input;
    }
    
    public function addUploadImage()
    {
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
    
    public function addMainFields()
    {
        $this->add(array(
                        'name' => 'titolo',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Titolo' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'title' => 'Inserisci il titolo',
                                        'id' => 'titolo',
                        )
        ));
        
        $this->add(array(
                        'name' => 'sottotitolo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Sotto titolo' ),
                        'attributes' => array(
                                        'class' => 'form-control',
                                        'title' => 'Inserisci il sotto titolo',
                                        'id' => 'sottotitolo',
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
            'type' => 'Date',
            'name' => 'dataScadenza',
            'options' => array(
                    'label' => 'Scadenza',
                    'format' => 'Y-m-d'
            ),
            'attributes' => array(
                    'class' => 'form-control DatePicker',
                    'style' => 'width: 22%',
                    'id' => 'dataScadenza'
            )
        ));
        
        /*
        $this->add(array(
            'name'=>'Test',
            'type'=>'Zend\Form\Element\Select',
            'attributes'=>array('type'=>'select','required'=>'required'),
            'options'=>array(
                'label' => 'Categoria',
                'value_options'=>array('fruits' => array('label' => 'Fruits', 'options' => array('1'=>'Apple','2'=>'Mango')), 
                        'animals' => array('label'=>'Animals','options'=>array('cat'=>'CAT','dog'=>'DOG') ), 
                        'attivo' => 'Attivo',
                    ),
                'empty_options' => 'Please Select'
            ),

        ));
        
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'category',
                        'options' => array(
                            'label' => 'Categoria',
                        ),
                        'attributes' => array(
                                        'id' => 'category',
                                        'value' => '&nbsp;',
                        ),
        ));
        */

        $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'stato',
             'options' => array(
                    'label' => 'Stato',
                    'value_options' => array(
                            '' => 'Seleziona',
                            'attivo' => 'Attivo',
                            'nascosto' => 'Nascosto',
                    ),
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
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'postid',
            'attributes' => array("class" => 'hiddenField')
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
        
        /**
         * @param \Application\Model\Categorie\CategorieGetter $categorieGetter
         * @return array
        
        private function getCategories(\Application\Model\Categorie\CategorieGetter  $categorieGetter)
        {
            $categorieGetter->setMainQuery();

            return $categorieGetter->getQueryResult();
        } */
}
