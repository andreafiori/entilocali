<?php

namespace Admin\Model\AttiConcessione;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class AttiConcessioneForm extends Form
{
    /**
     * @param type $name
     * @param type $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'beneficiario',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Beneficiario CF/PIVA' ),
                        'attributes' => array(
                                        'title' => 'Beneficiario CF/PIVA',
                                        'id'    => 'beneficiario',
                        )
        ));
        
        $this->add(array(
                        'name' => 'importo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Importo (Euro)' ),
                        'attributes' => array(
                                        'title' => 'Importo (Euro)',
                                        'id'    => 'importo',
                        )
        ));
    }
    
    public function addUfficioResponsabile($records)
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'sezione',
                        'options' => array(
                               'label' => 'Ufficio - Responsabile',
                               'empty_option' => 'Seleziona',
                               'value_options' => $records,
                        ),
                        'attributes' => array(
                                'id' => 'sezione'
                        )
        ));
    }
    
    public function addResponsabileProcedimento()
    {
        // Responsabile del Procedimento
    }
    
    public function addModalitaAssegnazione()
    {        
        $this->add(array(
                        'name' => 'modassegn',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Modalità Assegnazione' ),
                        'attributes' => array(
                                        'title' => 'Modalità Assegnazione',
                                        'id'    => 'modassegn',
                        )
        ));
        
        // Norma o Titolo a base dell'attribuzione
        
        // Data inserimento: (inserire data in formato GG-MM-AAAA). l'articolo sarà visibile in front-end a partire da questa data
        
        // Anno del Bando: 2014 (la modifica avviene dopo il salvataggio)
        
        // Data scadenza: 5 Anni a partire dall'anno successivo a quello di inserimento
        
        // Associa articolo a utente: se utente non admin visualizza id campo nascosto, altrimenti select area
    }
    
}
