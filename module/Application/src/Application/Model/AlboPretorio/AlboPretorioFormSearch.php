<?php

namespace Application\Model\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioArticoliFormAbstract;

/**
 * Albo Pretorio Frontend Search Form
 * 
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class AlboPretorioFormSearch extends AlboPretorioArticoliFormAbstract
{
    /**
     * @inheritdoc
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
                'id'     => 'numero_progressivo',
                'type'   => 'number',
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
                'id'     => 'numero_atto',
                'type'   => 'number',
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
                'title' => 'Seleziona anno di partenza dalla data di pubblicazione',
                'id'    => 'anno'
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
            'name' => 'expired',
            'attributes' => array(
                'title'  => 'Spunta casella per cercare fra i documenti scaduti',
                'id'     => 'expired'
            ),
            'options' => array(
                'label'              => 'Cerca anche nei documenti scaduti',
                'use_hidden_element' => false,
                'checked_value'      => 1,
                'unchecked_value'    => 0
            )
        ));
    }
    
    public function addCsrf()
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
    }
    
    public function addFrontendSubmitButton()
    {
        $this->add(array(
            'name' => 'search',
            'type'  => 'submit',
            'attributes' => array(
                'label' => '&nbsp;',
                'title' => "Premi per avviare la ricerca sull'albo pretorio",
                'value' => 'Cerca',
            ))
        );
    }
}