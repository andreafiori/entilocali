<?php

namespace ModelModule\Model\ContrattiPubblici;

use Zend\Form\Form;

class ContrattiPubbliciFormSearch extends Form
{
    /**
     * @param array $arrayYears
     */
    public function addYears(array $arrayYears)
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'anno',
                        'options' => array(
                               'label' => 'Anno',
                               'value_options' => $arrayYears,
                                'empty_option' => 'Seleziona',
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona anno pubblicazione',
                                'id'    => 'anno'
                        )
        ));
    }
    
    public function addMainFormElements()
    {
        $this->add(array(
                        'name' => 'cig',
                        'type' => 'Text',
                        'options' => array( 'label' => 'CIG (Codice Identificativo di Gara)' ),
                        'attributes' => array(
                                        'id'        => 'cig',
                                        'title'     => 'Inserisci Codice Identificativo di Gara',
                                        'maxlength' => 10,
                                        'placeholder' => 'CIG...',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'importo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Importo aggiudicazione (Euro)' ),
                        'attributes' => array(
                                        'id'        => 'importo',
                                        'title'     => "Inserisci l'importo aggiudicazione",
                                        'maxlength' => 35,
                                        'placeholder' => 'Importo...'
                        ),
        ));
    }
    
    /**
     * @param array $arrayOfValues
     */
    public function addSettori(array $arrayOfValues)
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'ufficio',
                        'options' => array(
                               'label' => 'Ufficio e responsabile servizio',
                               'value_options'  => $arrayOfValues,
                               'empty_option'   => 'Seleziona',
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona ufficio e responsabile servizio',
                                'id'    => 'ufficio'
                        )
        ));
    }
    
    public function addSubmit()
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Submit',
                        'name' => 'search',
                        'options' => array(
                               'label' => ' ',
                                'label_options' => array(
                                    'disable_html_escape' => true,
                                ),
                        ),
                        'attributes' => array(
                                'id'    => 'search',
                                'value' => 'Cerca',
                                'title' => 'Avvia ricerca fra i contatti pubblici',
                        )
        ));
    }
}
