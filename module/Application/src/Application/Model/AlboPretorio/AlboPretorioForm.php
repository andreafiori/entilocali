<?php

namespace Application\Form;

use Zend\Form\Form;

/**
 * Albo Pretorio Frontend Search Form
 * TODO:
 *      complete the form and show it on the view 
 *      select sections and sectors from db
 * 
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class AlboPretorioForm extends Form
{
    public function __construct($name = null) 
    {
        parent::__construct('albo-pretorio-search-form');
        
        $this->setAttribute('method', 'post'); 

        $this->add(array(
            'name' => 'testo', 
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Inserisci testo...',
                'title' => 'Inserisci testo...',
            ),
            'options' => array(
                'label' => 'Nome',
            ),
        ));
        
        $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'mese',
             'options' => array(
                     'label' => 'Mese',
                     'value_options' => array(
                                '1' => 'Gennaio',
                                '2' => 'Febbraio',
                                '3' => 'Marzo',
                                '4' => 'Aprile',
                                '5' => 'Maggio',
                                '6' => 'Giugno',
                                '7' => 'Luglio',
                                '8' => 'Agosto',
                                '9' => 'Settembre',
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
        $arrayYears = array();
        $arrayYears[date("Y")] = date("Y");
        
        for($i=$arrayYears[date("Y")]; $i < date("Y")+7; $i++)
        {
            $arrayYears[$i] = $i;
        }
    }
}