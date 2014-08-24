<?php

namespace Application\Model\StatoCivile;

use Zend\Form\Form;

/**
 * Stato Civile Frontend Search Form
 * 
 * @author Andrea Fiori
 * @since  24 July 2014
 */
class StatoCivileFormSearch extends Form
{
    /**
     * @param type $name
     * @param type $options
     */
    public function __construct($name = null, $options = array())
    {    
        parent::__construct($name, $options);
 
        $this->add(array(
            'type' => 'Text',
            'name' => 'testo',
            'attributes' => array(
                'placeholder' => 'Inserisci testo...',
                'title'  => 'Inserisci testo',
                'id'     => 'testo'
            ),
            'options' => array(
                'label' => 'Testo',
            )
        ));
    }
    
    public function addMesi()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'mese',
            'attributes' => array(
                'title' => 'Seleziona mese',
                'id'    => 'mese'
            ),
            'empty_option' => 'Mese',
            'options' => array(
                    'label' => 'Mese',
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
    
    public function addAnni()
    {
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
    
        private function getArrayYears()
        {
            $arrayYears = array('' => 'Anno');

            for($i=date("Y"); $i < date("Y")+7; $i++) {
                $arrayYears[$i] = $i;
            }
            
            return $arrayYears;
        }
    
    public function addSezioni($sezioni)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sezione',
            'attributes' => array(
                'title' => 'Seleziona sezione',
                'id'    => 'sezione'
            ),
            'options' => array(
                    'label' => 'Sezione',
                    'empty_option' => 'Sezione',
                    'value_options' => $sezioni
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
                'id' => 'search',
            ))
        );
    }
}
