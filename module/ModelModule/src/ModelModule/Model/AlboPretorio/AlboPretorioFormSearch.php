<?php

namespace ModelModule\Model\AlboPretorio;

use Zend\Form\Form as ZendForm;

/**
 * Albo Pretorio form search
 */
class AlboPretorioFormSearch extends ZendForm
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = null)
    {
        parent::__construct($name);
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'numero_progressivo',
            'attributes' => array(
                'placeholder'   => 'Nr...',
                'title'         => 'Inserisci numero repertorio',
                'id'            => 'numero_progressivo',
                'type'          => 'number',
                'maxlength'     => 10,
            ),
            'options' => array(
                'label' => 'Numero repertorio',
            )
        ));
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'numero_atto',
            'attributes' => array(
                'placeholder' => 'Nr...',
                'title'     => 'Inserisci numero atto',
                'id'        => 'numero_atto',
                'type'      => 'number',
                'maxlength' => 10,
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
                'title'     => "Inserisci testo della ricerca sull'albo",
                'id'        => 'testo',
                'maxlength' => 230,
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

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3200
                )
            )
        ));
    }

    /**
     * @param array $sezioni
     *
     * @return bool|null
     */
    public function addSezioni($sezioni)
    {
        if ( empty($sezioni) ) {
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
     * @param array $years
     */
    public function addYears($years = null)
    {
        if (!is_array($years)) {
            $years = array();
            for($i = date("Y")-3; $i < date("Y")+5; $i++) {
                $years[$i] = $i;
            }
        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'anno',
            'attributes' => array(
                'title' => 'Seleziona anno',
                'id'    => 'anno'
            ),
            'options' => array(
                'label' => 'Anno',
                'empty_option'  => 'Anno',
                'value_options' => $years,
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
                    'aa.anno'               => 'Anno',
                    'aa.numeroAtto'         => 'Numero Progressivo',
                    'aa.titolo'             => 'Titolo',
                    'aa.dataAttivazione'    => 'Data Attivazione',
                    'aa.dataScadenza'       => 'Data Scadenza',
                    'aps.nome'              => 'Sezione',
                    'aps.nome'              => 'Settore',
                ),
            )
        ));
    }

    public function addHomePage()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'home',
            'options' => array(
                'label' => 'In home page',
                'use_hidden_element' => true,
                'checked_value'     => '1',
                'unchecked_value'   => '',
            ),
            'attributes' => array('id' => 'home')
        ));
    }

    /**
     * @param string $name
     * @param string $label
     */
    public function addSubmitButton($name = null, $label = null)
    {
        $this->add(array(
                'name' => 'search',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => '&nbsp;',
                    'title' => "Premi per avviare la ricerca sugli atti dell'albo pretori\o",
                    'value' => 'Cerca',
                    'id'    => 'submit',
                ))
        );
    }

    public function addResetButton()
    {
        $this->add(array(
                'name' => 'resetForm',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => ' ',
                    'title' => "Premi il pulsante per resettare il form di ricerca",
                    'value' => 'Reset',
                    'id'    => 'resetForm',
                    'type'  => 'reset'
                ))
        );
    }
}