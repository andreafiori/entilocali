<?php

namespace ModelModule\Model\Posts;

use Zend\Form\ElementInterface;
use Zend\Form\Form;

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

        /**
         * @return array
         */
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

    public function addTitle()
    {
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array('label' => '* Titolo'),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Inserisci il titolo',
                'title'         => 'Inserisci il titolo',
                'id'            => 'title',
            )
        ));
    }

    public function addSubtitle()
    {
        $this->add(array(
            'name' => 'subtitle',
            'type' => 'Text',
            'options' => array('label' => 'Sottotitolo'),
            'attributes' => array(
                'title'         => 'Inserisci il sottotitolo',
                'placeholder'   => 'Inserisci il sottotitolo',
                'id'            => 'subtitle',
            )
        ));
    }

    /**
     * Add description textare with wysiwyg class
     */
    public function addDescription()
    {
        $this->add(array(
            'name' => 'description',
            'type' => 'Textarea',
            'options' => array( 'label' => '* Descrizione' ),
            'attributes' => array(
                'id'        => 'description',
                'required'  => 'required',
                'class'     => 'wysiwyg',
                'title'     => 'Inserisci descrizione',
                'rows'      => 8,
                'cols'      => 20,
            )
        ));
    }

    public function addMainFields()
    {
        $this->add(array(
                        'name' => 'description',
                        'type' => 'Textarea',
                        'options' => array( 'label' => '* Descrizione' ),
                        'attributes' => array(
                                        'id'        => 'description',
                                        'required'  => 'required',
                                        'class'     => 'wysiwyg',
                                        'title'     => 'Inserisci descrizione',
                                        'rows'      => 8,
                                        'cols'      => 20,
                        )
        ));
        
        $this->add(array(
                        'type' => 'DateTime',
                        'name' => 'expireDate',
                        'options' => array(
                                'label'     => '* Scadenza',
                                'format'    => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'style' => 'width: 22%',
                                'id'    => 'expireDate',
                                'required'  => 'required',
                                'title'     => 'Seleziona data scadenza',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'status',
                        'options' => array(
                               'label' => '* Stato',
                                'empty_option' => 'Seleziona',
                                'value_options' => array(
                                       1 => 'Attivo',
                                       0 => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'id'        => 'status',
                                'required'  => 'required',
                                'title'     => 'Seleziona stato',
                        )
        ));
  
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
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
                'id'        => 'categories',
                'title'     => 'Seleziona almeno una categoria',
                'required'  => 'required'
            )
        ));
    }

    public function addSeo()
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

    public function addHome()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'inhome',
            'options' => array(
                'label' => 'Inserisci in home page',
                'checked_value'     => 1,
                'unchecked_value'   => 0
            ),
            'attributes' => array(
                'id'    => 'inhome',
                'title' => 'Inserisci in home page'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'rss',
            'options' => array(
                'label' => 'Inserisci nel box notizie',
                'checked_value'     => 1,
                'unchecked_value'   => 0
            ),
            'attributes' => array(
                'id'    => 'rss',
                'title' => 'Spunta la casella per inserire nel box notizie'
            )
        ));
    }

    public function addFacebook()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'rss',
            'options' => array(
                'label' => 'Inserisci su facebook',
                'checked_value'     => 1,
                'unchecked_value'   => 0
            ),
            'attributes' => array(
                'id'    => 'rss',
                'title' => 'Spunta la casella per inserire un link alla pagina facebook'
            )
        ));
    }
}
