<?php

namespace ModelModule\Model\ContrattiPubblici;

use Zend\Form\Form;

class ContrattiPubbliciFormSearch extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = null)
    {
        parent::__construct($name, $options);

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
                        'name' => 'settore',
                        'options' => array(
                               'label' => 'Ufficio e responsabile servizio',
                               'value_options'  => $arrayOfValues,
                               'empty_option'   => 'Seleziona',
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona ufficio e responsabile servizio',
                                'id'    => 'settore'
                        )
        ));
    }

    public function addAttivo()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'attivo',
            'attributes' => array(
                'title'  => 'Spunta casella per cercare fra i bandi attivi',
                'id'     => 'expired'
            ),
            'options' => array(
                'label'              => 'Cerca bandi attivi e visibili sul sito pubblico',
                'use_hidden_element' => false,
                'checked_value'      => 1,
                'unchecked_value'    => 0
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

    public function addInHome()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'inhome',
            'options' => array(
                'label'              => 'in home page',
                'use_hidden_element' => false,
                'checked_value'      => 1,
                'unchecked_value'    => 0,
            ),
            'required' => false,
            'attributes' => array(
                'id'    => 'inhome',
                'title' => "Presente in home page"
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
