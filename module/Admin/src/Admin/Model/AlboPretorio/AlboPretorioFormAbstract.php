<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Form;

abstract class AlboPretorioFormAbstract extends Form
{   
    /**
     * @param array $sezioni
     */
    public function addSezioni($sezioni)
    {
        if (!is_array($sezioni)) {
            return false;
        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sezione',
            'attributes' => array(
                'title' => 'Seleziona sezione',
                'id'    => 'sezione'
            ),
            'options' => array(
                    'label' => 'Sezione',
                    'empty_option' => 'Seleziona',
                    'value_options' => $sezioni,
            )
        ));
    }
    
    /**
     * @param type $settori
     */
    public function addSettori($settori)
    {
        if (!$settori) {
            return false;
        }
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'settore',
            'attributes' => array(
                'title' => 'Seleziona settore',
                'id'    => 'settore'
            ),
            'options' => array(
                'label' => 'Settore',
                'empty_option' => 'Seleziona',
                'value_options' => $settori,
            )
        ));
    }
    
    public function addMonths()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'mese',
            'attributes' => array(
                'title' => 'Seleziona mese',
                'id'    => 'testo'
            ),
            'options' => array(
                    'label' => 'Mese',
                    'empty_option'  => 'Mese',
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
                'title' => 'Seleziona anno',
                'id'    => 'testo'
            ),
            'options' => array(
                    'label' => 'Anno',
                    'empty_option'  => 'Anno',
                    'value_options' => $years,
             )
        ));
    }

        // TO DELETE, take available years from db
        protected function getArrayYears()
        {
            $arrayYears = array('' => 'Anno');

            for($i=date("Y"); $i < date("Y")+7; $i++) {
                $arrayYears[$i] = $i;
            }

            return $arrayYears;
        }
}
