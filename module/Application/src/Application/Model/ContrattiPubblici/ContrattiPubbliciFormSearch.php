<?php

namespace Application\Model\ContrattiPubblici;

use Zend\Form\Form;

/**
 * Contratti Pubblici Form Search Frontend
 * 
 * @author Andrea Fiori
 * @since  24 July 2014
 */
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
                                'title' => 'Seleziona anno',
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
                                        'id' => 'cig',
                                        
                                        'title' => 'Inserisci Codice Identificativo di Gara',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'importo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Importo aggiudicazione (Euro) &euro;' ),
                        'attributes' => array(
                                        'id' => 'importo',
                                        'title' => "Inserisci l'importo aggiudicazione",
                        ),
        ));
        
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
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
                               'value_options' => $arrayOfValues,
                               'empty_option' => 'Seleziona',
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
                        'name' => 'cerca',
                        'options' => array(
                               'label' => 'Cerca',
                        ),
                        'attributes' => array(
                                'title' => 'Cerca fra i contatti pubblici',
                                'id'    => 'cerca',
                                'value' => 'Cerca',
                        )
        ));
    }
}
