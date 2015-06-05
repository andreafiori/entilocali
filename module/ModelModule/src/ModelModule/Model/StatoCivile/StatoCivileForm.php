<?php

namespace ModelModule\Model\StatoCivile;

use Zend\Form\ElementInterface;
use Zend\Form\Form;

class StatoCivileForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'titolo',
                        'type' => 'Textarea',
                        'options' => array( 'label' => '* Titolo' ),
                        'attributes' => array(
                                        'id'            => 'titolo',
                                        'required'      => 'required',
                                        'palceholder'   => 'Inserisci il titolo',
                                        'title'         => 'Inserisci il titolo',
                                        'rows'          => '3',
                                        'maxlength'     => 250
                        )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class" => 'hiddenField')
        ));
    }

    /**
     * @param array $sezioni
     */
    public function addSezioni(array $sezioni)
    {
        $this->add(array(
                    'type' => 'Zend\Form\Element\Select',
                    'name' => 'sezione',
                    'options' => array(
                           'label' => '* Sezione',
                           'empty_option' => 'Seleziona',
                           'value_options' => $sezioni,
                    ),
                    'attributes' => array(
                            'id'        => 'sezione',
                            'title'     => 'Seleziona la sezione',
                            'required'  => 'required',
                    )
        ));
    }
    
    public function addDates()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'attivo',
            'options' => array(
                'label' => '* Stato',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    1   => 'Attivo',
                    0   => 'Nascosto',
                ),
            ),
            'attributes' => array(
                'required' => 'required',
                'id'       => 'attivo',
                'title'    => 'Seleziona stato',
            )
        ));

        $this->add(array(
                        'type' => 'Date',
                        'name' => 'data',
                        'options' => array(
                                'label' => '* Data di pubblicazione',
                                'format' => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'id'            => 'data',
                                'title'         => 'Inserisci la data di pubblicazione',
                                'placeholder'   => 'Data di pubblicazione...',
                                'required'      => 'required',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'scadenza',
                        'options' => array(
                                'label'  => '* Data di scadenza',
                                'format' => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'id'          => 'scadenza',
                                'title'       => 'Inserisci la data di scadenza',
                                'placeholder' => 'Data di scadenza...',
                                'required'    => 'required',
                        )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'homepageFlag',
            'attributes' => array(
                'title' => 'Inserisci in home page',
                'id'    => 'homepageFlag'
            ),
            'options' => array(
                'label' => 'Inserisci in home page',
                'use_hidden_element' => false,
                'checked_value'      => 1,
                'unchecked_value'    => 0
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'boxNotizie',
            'attributes' => array(
                'title' => 'Inserisci nel box notizie',
                'id'    => 'boxNotizie'
            ),
            'options' => array(
                'label' => 'Inserisci nel box notizie',
                'use_hidden_element' => false,
                'checked_value'      => 1,
                'unchecked_value'    => 0
            )
        ));
    }
}