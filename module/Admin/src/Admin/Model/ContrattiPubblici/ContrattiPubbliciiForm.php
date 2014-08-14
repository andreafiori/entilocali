<?php

namespace Admin\Model\ContrattiPubblici;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  26 June 2014
 */
class ContrattiPubbliciBandiForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'cig',
                        'type' => 'Text',
                        'options' => array( 'label' => 'CIG (Codice Identificativo di Gara)' ),
                        'attributes' => array(
                                        'id' => 'cig',
                                        'class' => 'form-control',
                                        'title' => 'Inserisci Codice Identificativo di Gara',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'titolo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Oggetto del bando' ),
                        'attributes' => array(
                                        'id' => 'titolo',
                                        'class' => 'form-control',
                                        'title' => "Inserisci l'oggetto del bando",
                        ),
        ));
        
        /*** IMPORTI ***/
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'importi_label',
                        'attributes' => array(
                                        'id'    => 'importi_label',
                                        'value' => '<h3><span class="label label-info">Importi</span></h3>',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'importo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Importo aggiudicazione (Euro): &euro;' ),
                        'attributes' => array(
                                        'id' => 'importo',
                                        'class' => 'form-control',
                                        'title' => "Inserisci l'importo aggiudicazione",
                        ),
        ));
        
        $this->add(array(
                        'name' => 'importo2',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Importo delle somme liquidate (Euro): &euro;' ),
                        'attributes' => array(
                                        'id' => 'importo2',
                                        'class' => 'form-control',
                                        'title' => "Inserisci l'oggetto del bando",
                        ),
        ));
        
        /*** STRUTTURA PROPONENTE ***/
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'struttura_label',
                        'attributes' => array(
                                        'id'    => 'struttura_label',
                                        'value' => '<h3><span class="label label-info">Struttura Proponente</span></h3>',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'id_sezione',
                        'options' => array(
                               'label' => 'Struttura proponente - Responsabile',
                               'value_options' => array(
                                       '' => 'Seleziona',
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
                                        'value' => '<h4>NUMERO DI OFFERTE AMMESSE</h4>',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'importo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Numero di offerte ammesse' ),
                        'attributes' => array(
                                        'id'    => 'importo',
                                        'class' => 'form-control',
                                        'title' => "Inserisci numero di offerte ammesse",
                        ),
        ));
        
        /*** TEMPI DI COMPLETAMENTO ***/
        
        /*** PROCEDURA DI SCELTA DEL CONTRAENTE ***/
        
        // Data inserimento: (inserire data in formato GG-MM-AAAA) l'articolo sarà visibile in front-end a partire da questa data: 
        // Anno del Bando: 2014 (la modifica avviene dopo il salvataggio)
        // Data di scadenza: 5 Anni a partire dall'anno successivo a quello di inserimento
    }
}