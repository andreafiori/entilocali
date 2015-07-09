<?php

namespace ModelModule\Model\StatoCivile;

use Zend\Form\Form;

/**
 * Stato civile form search
 */
class StatoCivileFormSearch extends Form
{
    public function addTesto()
    {
        $this->add(array(
            'type' => 'Text',
            'name' => 'testo',
            'attributes' => array(
                'placeholder'   => 'Testo...',
                'title'         => 'Inserisci testo',
                'id'            => 'testo',
                'maxlength'     => 150,
            ),
            'options' => array(
                'label' => 'Testo',
            )
        ));
    }

    public function addProgressivo()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'numero_progressivo',
            'attributes' => array(
                'placeholder'   => 'Numero...',
                'title'         => 'Inserisci numero repertorio',
                'id'            => 'numero_progressivo',
                'maxlength'     => 15
            ),
            'options' => array(
                'label' => 'Numero repertorio',
            )
        ));
    }

    public function addNumeroAtto()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'numero_atto',
            'attributes' => array(
                'placeholder' => 'Atto...',
                'title'         => 'Inserisci numero atto',
                'id'            => 'numero_atto',
                'maxlength'     => 15
            ),
            'options' => array(
                'label' => 'Numero atto',
            )
        ));
    }

    public function addMese()
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
     * @param mixed $years
     */
    public function addAnni($years = null)
    {
        if (empty($years)) {
            $years = array();
            for($i = date("Y"); $i<date("Y")+5; $i++) {
                $years[$i] = $i;
            }
        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'anno',
            'attributes' => array(
                'title' => 'Seleziona anno di partenza dalla data di pubblicazione',
                'id'    => 'anno'
            ),
            'options' => array(
                'empty_option'  => 'Anno',
                'label'         => 'Anno',
                'value_options' => $years
            )
        ));
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

    public function addCheckExpired()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'expired',
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

    public function addInHome()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'expired',
            'attributes' => array(
                'title' => 'Cerca atto presente in home page',
                'id'    => 'homepage'
            ),
            'options' => array(
                'label' => 'Presente in home page',
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
                'id'    => 'search',
                'title' => 'Cerca fra le pubblicazioni stato civile'
            ))
        );
    }
}
