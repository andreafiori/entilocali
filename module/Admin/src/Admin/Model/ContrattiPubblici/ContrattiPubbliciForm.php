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
            'options' => array('label' => '<abbr title="Codice Identificativo di Gara">CIG</abbr>'),
            'attributes' => array(
                'id' => 'cig',
                'title' => 'Inserisci Codice Identificativo di Gara',
                'placeholder' => 'CIG',
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'titolo',
            'type' => 'Text',
            'options' => array('label' => 'Oggetto del bando'),
            'attributes' => array(
                'id' => 'titolo',
                'title' => "Inserisci l'oggetto del bando",
                'placeholder' => 'Oggetto...',
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'importi_label',
            'attributes' => array(
                'id' => 'importi_label',
                'value' => 'Importi',
                'type' => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'name' => 'importo',
            'type' => 'Text',
            'options' => array('label' => 'Importo aggiudicazione (Euro): &euro;'),
            'attributes' => array(
                'id' => 'importo',
                'title' => "Inserisci l'importo aggiudicazione",
                'placeholder' => 'Importo aggiudicazione...',
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'importo2',
            'type' => 'Text',
            'options' => array('label' => 'Importo delle somme liquidate (Euro): &euro;'),
            'attributes' => array(
                'id' => 'importo2',
                'title' => "Inserisci l'importo somme liquidate",
                'placeholder' => 'Importo somme liquidate...',
                'required' => 'required'
            ),
        ));
    }

    public function addStrutturaProponente($records)
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'struttura_label',
            'attributes' => array(
                'id' => 'struttura_label',
                'value' => 'Struttura Proponente',
                'type' => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'id_sezione',
            'options' => array(
                'label' => 'Struttura proponente - responsabile',
                'empty_option' => 'Seleziona',
                'value_options' => array($records),
            ),
            'attributes' => array(
                'title'     => 'Seleziona la struttura proponente',
                'id'        => 'id_sezione',
                'required'  => 'required'
            )
        ));
    }

    public function addResponsabili($records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'id_resp_proc',
            'options' => array(
                'label'         => 'Responsabile del procedimento',
                'empty_option'  => 'Seleziona',
                'value_options' => $records,
            ),
            'attributes' => array(
                'title'     => 'Responsabile del Procedimento',
                'id'        => 'id_resp_proc',
                'required'  => 'required'
            )
        ));
    }

    public function addNumeroOfferteEDate()
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'struttura_label',
            'attributes' => array(
                'id'    => 'struttura_label',
                'value' => 'NUMERO DI OFFERTE AMMESSE',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'name' => 'numeroOfferte',
            'type' => 'Text',
            'options' => array( 'label' => 'Numero di offerte ammesse' ),
            'attributes' => array(
                'id'            => 'numeroOfferte',
                'title'         => "Inserisci numero di offerte ammesse",
                'placeholder'   => 'Offerte...',
                'required'      => 'required'
            ),
        ));

        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'struttura_label',
            'attributes' => array(
                'id'    => 'struttura_label',
                'value' => 'Tempi di completamento',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'type' => 'Date',
            'name' => 'data_agg',
            'options' => array(
                'label' => 'Data aggiudicazione (Inizio lavori)',
                'format' => 'Y-m-d',
            ),
            'attributes' => array(
                'id' => 'data_agg',
                'required' => 'required'
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
                'id' => 'data_contratto',
                'required' => 'required'
            )
        ));
    }

    public function addSceltaContraente($records)
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'procedura_scelta_label',
            'attributes' => array(
                'id'    => 'procedura_scelta_label',
                'value' => 'PROCEDURA DI SCELTA DEL CONTRAENTE',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sc_contr_id',
            'options' => array(
                'label' => '* Scelta del contraente',
                'value_options' => $records,
            ),
            'attributes' => array(
                'title' => 'Seleziona la scelta del contraente',
                'id'    => 'sc_contr_id',
                'required' => 'required'
            )
        ));
    }

    public function addDatePubblicazione()
    {
        $this->add(array(
            'type' => 'Date',
            'name' => 'inserimento',
            'options' => array(
                'label' => 'Data inserimento: l\'articolo sarà visibile in front-end a partire da questa data',
                'format' => 'Y-m-d',
            ),
            'attributes' => array(
                'id'        => 'inserimento',
                'title'     => 'Seleziona data pubblicazione',
                'required'  => 'required',
            )
        ));

        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'struttura_label',
            'attributes' => array(
                'id'    => 'struttura_label',
                'value' => 'DATA INSERIMENTO \ ANNO DEL BANDO \ DATA SCADENZA',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'struttura_label',
            'attributes' => array(
                'id'    => 'struttura_label',
                'value' => "Data di scadenza:  5 Anni a partire dall'anno successivo a quello di inserimento",
                'type'  => 'PlainText'
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
                                            'value' => 'UTENTE',
                                            'type'  => 'PlainTextTitle',
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