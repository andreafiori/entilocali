<?php

namespace Admin\Model\ContrattiPubblici;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  26 June 2014
 */
class ContrattiPubbliciForm extends Form
{
    /**
     * @param string $name
     * @param string $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
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
                        'name' => 'titolo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Oggetto del bando' ),
                        'attributes' => array(
                                        'id'    => 'titolo',
                                        'title' => "Inserisci l'oggetto del bando",
                        ),
        ));
        
        /*** IMPORTI ***/
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'importi_label',
                        'attributes' => array(
                                        'id'    => 'importi_label',
                                        'value' => '<h4><strong>Importi</strong></h4>',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'importo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Importo aggiudicazione (Euro): &euro;' ),
                        'attributes' => array(
                                        'id' => 'importo',
                                        'title' => "Inserisci l'importo aggiudicazione",
                        ),
        ));
        
        $this->add(array(
                        'name' => 'importo2',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Importo delle somme liquidate (Euro): &euro;' ),
                        'attributes' => array(
                                        'id' => 'importo2',
                                        'title' => "Inserisci l'oggetto del bando",
                        ),
        ));
        
        /*** STRUTTURA PROPONENTE ***/
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'struttura_label',
                        'attributes' => array(
                                        'id'    => 'struttura_label',
                                        'value' => '<h4><strong>Struttura Proponente</strong></h4>',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'id_sezione',
                        'options' => array(
                               'label' => 'Struttura proponente - Responsabile',
                               'empty_option' => 'Seleziona',
                               'value_options' => array(
                                       'attivo'   => 'Attivo',
                                       'nascosto' => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona la struttura proponente',
                                'id'    => 'id_sezione'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'id_resp_proc',
                        'options' => array(
                               'label' => 'Responsabile del Procedimento',
                               'value_options' => array(
                                       '' => 'Seleziona',
                                       'attivo'   => 'Attivo',
                                       'nascosto' => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'title' => 'Responsabile del Procedimento',
                                'id'    => 'id_resp_proc'
                        )
        ));

        /*** NUMERO DI OFFERTE AMMESSE ***/
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'struttura_label',
                        'attributes' => array(
                                        'id'    => 'struttura_label',
                                        'value' => '<h4><strong>NUMERO DI OFFERTE AMMESSE</strong></h4>',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'importo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Numero di offerte ammesse' ),
                        'attributes' => array(
                                        'id'    => 'importo',
                                        'title' => "Inserisci numero di offerte ammesse",
                        ),
        ));
        
        /*** TEMPI DI COMPLETAMENTO ***/
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'struttura_label',
                        'attributes' => array(
                                        'id'    => 'struttura_label',
                                        'value' => '<h4><strong>Tempi di completamento</strong></h4>',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'data_agg',
                        'options' => array(
                                'label' => 'Data Aggiudicazione (Inizio lavori)',
                                'format' => 'Y-m-d',
                        ),
                        'attributes' => array(
                                'id' => 'data_agg'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'data_contratto',
                        'options' => array(
                                'label' => 'Data Contratto (Fine lavori)',
                                'format' => 'Y-m-d',
                        ),
                        'attributes' => array(
                                'id' => 'data_contratto'
                        )
        ));
        
        /*** PROCEDURA DI SCELTA DEL CONTRAENTE ***/
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'struttura_label',
                        'attributes' => array(
                                        'id'    => 'struttura_label',
                                        'value' => '<h4><strong>PROCEDURA DI SCELTA DEL CONTRAENTE</strong></h4>',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'sc_contr_id',
                        'options' => array(
                               'label' => 'Scelta del contraente',
                               'value_options' => array(),
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona la scelta del contraente',
                                'id'    => 'sc_contr_id'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'inserimento',
                        'options' => array(
                                'label' => 'Data inserimento: l\'articolo sarà visibile in front-end a partire da questa data',
                                'format' => 'Y-m-d',
                        ),
                        'attributes' => array(
                                'id' => 'inserimento'
                        )
        ));
                
        // DATA INSERIMENTO \ ANNO DEL BANDO \ DATA SCADENZA
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'struttura_label',
                        'attributes' => array(
                                        'id'    => 'struttura_label',
                                        'value' => '<h4><strong>DATA INSERIMENTO \ ANNO DEL BANDO \ DATA SCADENZA</strong></h4>',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'struttura_label',
                        'attributes' => array(
                                        'id'    => 'struttura_label',
                                        'value' => "<p><strong>Data di scadenza:  5 Anni a partire dall'anno successivo a quello di inserimento</strong></p>",
                        ),
        ));
    }
    
    public function addUsersSelect(array $usersRecords)
    {
        if (isset($usersRecords)) {          
            $this->add(array(
                            'type' => 'Application\Form\Element\PlainText',
                            'name' => 'struttura_label',
                            'attributes' => array(
                                            'id'    => 'struttura_label',
                                            'value' => '<h4><strong>UTENTE</strong></h4>',
                            ),
            ));

            $this->add(array(
                            'type' => 'Zend\Form\Element\Select',
                            'name' => 'utente_id',
                            'options' => array(
                                   'label' => 'Associa articolo a utente',
                                   'value_options' => $usersRecords,
                            ),
                            'attributes' => array(
                                    'title' => 'Seleziona utente',
                                    'id'    => 'utente_id'
                            )
            ));
        }
    }
}