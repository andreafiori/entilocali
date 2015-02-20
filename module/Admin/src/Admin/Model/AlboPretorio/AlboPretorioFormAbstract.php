<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  30 July 2014
 */
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
    
    public function addOrderBy()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'orderby',
            'attributes' => array(
                'title' => 'Ordina per',
                'id'    => 'orderby'
            ),
            'options' => array(
                'label' => 'Ordina per',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    'aa.anno'   => 'Anno',
                    'aa.numeroAtto' => 'Numero Progressivo',
                    'aa.titolo' => 'Titolo',
                    'aa.dataAttivazione' => 'Data Attivazione',
                    'aa.dataScadenza' => 'Data Scadenza',
                    'aps.nome'  => 'Sezione',
                    'aps.nome'  => 'Settore',
                ),
            )
        ));
    }
    
    public function addMonths()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'mese',
            'attributes' => array(
                'title' => 'Seleziona mese di partenza dalla data di pubblicazione',
                'id'    => 'mese'
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
    public function addYears($years = null)
    {
        if (!is_array($years)) {
            $years = array();
            for($i = date("Y"); $i < date("Y")+5; $i++) {
                $years[] = $i;
            }
        }
        
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

    /**
     * @param string $name
     * @param string $label
     */
    public function addSubmitButton($name = null, $label = null)
    {
        if (!$name) {
            $name = 'search';
        }

        if (!$label) {
            $label = 'Cerca';
        }

        $this->add(array(
            'name' => 'reset-form-search',
            'type' => '\Zend\Form\Element',
            'attributes' => array(
                'id'    => 'resetForm',
                'type'  => 'reset',
                'label' => '&nbsp;',
                'title' => 'Reset dati form',
                'submit' => 1,
                'value' => 'Reset dati di ricerca',
            ))
        );
        
        $this->add(array(
            'name' => $name,
            'type' => 'Submit',
            'attributes' => array(
                'id'    => $name,
                'label' => '&nbsp;',
                'title' => 'Clicca per inviare i dati del form',
                'value' => $label,
            ))
        );
    }
}
