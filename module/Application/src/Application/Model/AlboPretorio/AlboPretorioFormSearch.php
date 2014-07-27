<?php

namespace Application\Model\AlboPretorio;

use Zend\Form\Form;

/**
 * Albo Pretorio Frontend Search Form
 * 
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class AlboPretorioFormSearch extends Form
{
    public function __construct($name = null) 
    {
        parent::__construct('albo-pretorio-search-form');
        
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
        // Atti inseriti a partire da: mese \ anno
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
             'options' => array(
                    'label' => 'Anno',
                    'value_options' => $this->getArrayYears(),
             )
        ));
    }
    
    public function addSezioni($sezioni)
    {
        if (is_array($sezioni)) {
            $sezioni = array_merge( array('' => 'Seleziona'), $sezioni );

            $this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'sezione',
                'attributes' => array(
                    'title'         => 'Seleziona sezione',
                    'id'            => 'sezione'
                ),
                'options' => array(
                        'label' => 'Sezione',
                        'value_options' => $sezioni,
                )
            ));
        }
    }
    
    public function addSettori($settori)
    {
        $settori = array_merge( array('' => 'Seleziona'), $settori );

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'settore',
            'attributes' => array(
                'title' => 'Seleziona settore',
                'id'    => 'sezione'
            ),
            'options' => array(
                'label' => 'Settore',
                'value_options' => $settori,
            )
        ));
    }
    
    public function addCheckExpired()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'checkbox',
            'attributes' => array(
                'title'         => 'Spunta casella per cercare fra i documenti scaduti',
                'id'            => 'expired'
            ),
            'options' => array(
                'label' => 'Cerca anche nei documenti scaduti',
                'use_hidden_element' => true,
                'checked_value'      => 'good',
                'unchecked_value'    => 'bad'
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
    
        private function getArrayYears()
        {
            $arrayYears = array('' => 'Anno');

            for($i=date("Y"); $i < date("Y")+7; $i++) {
                $arrayYears[$i] = $i;
            }
            
            return $arrayYears;
        }
}