<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Form;

/**
 * Backend form search
 * 
 * @author Andrea Fiori
 * @since  31 October 2014
 */
class AlboPretorioFormSearch extends Form
{
    /**
     * @param string $name
     */
    public function __construct($name = null) 
    {
        parent::__construct($name);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'numero_progressivo',
            'attributes' => array(
                'placeholder'   => '',
                'title'         => 'Inserisci numero repertorio',
                'id'            => 'numero_progressivo',
                'maxlength'     => 15
            ),
            'options' => array(
                'label' => 'Numero repertorio',
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'numero_atto',
            'attributes' => array(
                'placeholder' => '',
                'title'         => 'Inserisci numero atto',
                'id'            => 'numero_atto',
                'maxlength'     => 15
            ),
            'options' => array(
                'label' => 'Numero atto',
            )
        ));
        
        $this->add(array(
            'name' => 'testo',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Ricerca...',
                'title' => "Inserisci testo della ricerca sull'albo",
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
                'title' => 'Seleziona mese di partenza dalla data di pubblicazione',
                'id'    => 'mese'
            ),
            'options' => array(
                'label' => 'Mese',
                'empty_option' => 'Mese',
                'value_options' => array(
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
    }
    
    /**
     * @param array $years
     */
    public function addYears(array $years)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'anno',
            'attributes' => array(
                'title' => 'Seleziona anno di partenza dalla data di pubblicazione',
                'id'    => 'anno'
            ),
            'options' => array(
                'label'         => 'Anno',
                'value_options' => $years,
            )
        ));
    }
}
