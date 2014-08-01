<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Form;
use Admin\Model\AlboPretorio\AlboPretorioFormAbstract;

/**
 * TODO: ADD: mese, anno, sezione, settore, testo...
 * 
 * @author Andrea Fiori
 * @since  30 July 2014
 */
class AlboPretorioSearchFilterForm extends AlboPretorioFormAbstract
{
    public function __construct($name = null, $options = array()) {
        
        parent::__construct($name, $options);
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'numero_atto',
            'attributes' => array(
                'placeholder' => '',
                'title'  => 'Inserisci numero atto',
                'id'     => 'numero_atto'
            ),
            'options' => array(
                'label' => 'Numero atto',
            )
        ));
    }
    
    public function addExpiredCheckbox()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'checkbox',
            'attributes' => array(
                'title' => "Barra l'opzione per cercare solo atti non scaduti",
                'id'    => 'expired'
            ),
            'options' => array(
                'label' => 'Cerca solo atti non scaduti',
                'use_hidden_element' => true,
                'checked_value'      => '1',
                'unchecked_value'    => '0'
            )
        ));
    }
    
    public function addSubmitButton()
    {
        $this->add(array(
            'name' => 'search',
            'type'  => 'submit',
            'attributes' => array(
                'label' => '&nbsp;',
                'value' => 'Cerca',
            ))
        );
    }
}