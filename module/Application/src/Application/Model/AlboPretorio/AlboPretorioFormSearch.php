<?php

namespace Application\Model\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioFormAbstract;

/**
 * Albo Pretorio Frontend Search Form
 * 
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class AlboPretorioFormSearch extends AlboPretorioFormAbstract
{
    /**
     * @param string $name
     */
    public function __construct($name = null) 
    {
        parent::__construct($name);
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'numero_progressivo',
            'attributes' => array(
                'placeholder' => '',
                'title'  => 'Inserisci numero repertorio',
                'id'     => 'numero_progressivo'
            ),
            'options' => array(
                'label' => 'Numero repertorio',
            )
        ));
        
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
        
        $this->add(array(
            'name' => 'testo',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Inserisci testo...',
                'title' => 'Inserisci testo',
                'id' => 'testo'
            ),
            'options' => array(
                'label' => 'Testo',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'mese',
            'attributes' => array(
                'title' => 'Seleziona mese',
                'id' => 'testo'
            ),
            'options' => array(
                'label' => 'Mese',
                'value_options' => array(
                    ''   => 'Mese',
                    '1'  => 'Gennaio',
                    '2'  => 'Febbraio',
                    '3'  => 'Marzo',
                    '4'  => 'Aprile',
                    '5'  => 'Maggio',
                    '6'  => 'Giugno',
                    '7'  => 'Luglio',
                    '8'  => 'Agosto',
                    '9'  => 'Settembre',
                    '10' => 'Ottobre',
                    '11' => 'Novembre',
                    '12' => 'Dicembre',
                ),
             )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'anno',
            'attributes' => array(
                'title' => 'Seleziona anno',
                'id' => 'anno'
            ),
            'options' => array(
                'label' => 'Anno',
                'value_options' => $this->getArrayYears(),
            )
        ));
    }

    public function addCheckExpired()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'checkbox',
            'attributes' => array(
                'title' => 'Spunta casella per cercare fra i documenti scaduti',
                'id'    => 'expired'
            ),
            'options' => array(
                'label' => 'Cerca anche nei documenti scaduti',
                'use_hidden_element' => true,
                'checked_value'      => '1',
                'unchecked_value'    => '0'
            )
        ));
    }
    
    public function addSubmitButton()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                    'csrf_options' => array(
                            'timeout' => 600
                    )
            )
        ));
        
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