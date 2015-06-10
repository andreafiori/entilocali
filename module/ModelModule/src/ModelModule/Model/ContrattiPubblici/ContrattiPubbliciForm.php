<?php

namespace ModelModule\Model\ContrattiPubblici;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;

class ContrattiPubbliciForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array(
                "class" => 'hiddenField'
            )
        ));

        $this->add(array(
            'name' => 'cig',
            'type' => 'Text',
            'options' => array('label' => '* <abbr title="Codice Identificativo di Gara">CIG</abbr>'),
            'attributes' => array(
                'id'            => 'cig',
                'title'         => 'Inserisci Codice Identificativo di Gara',
                'placeholder'   => 'CIG',
                'required'      => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'titolo',
            'type' => 'Text',
            'options' => array('label' => '* Oggetto del bando'),
            'attributes' => array(
                'id' => 'titolo',
                'title'       => "Inserisci l'oggetto del bando",
                'placeholder' => 'Oggetto...',
                'required'    => 'required'
            ),
        ));
    }

    public function addDetermina()
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'struttura_label',
            'attributes' => array(
                'id'    => 'struttura_label',
                'value' => 'Numero e data determina',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'name' => 'numeroDetermina',
            'type' => 'Text',
            'options' => array('label' => 'Numero'),
            'attributes' => array(
                'id'            => 'numeroDetermina',
                'title'         => "Inserisci numero determina",
                'placeholder'   => 'Numero...',
            ),
        ));

        $this->add(array(
            'type' => 'Date',
            'name' => 'dataDetermina',
            'options' => array(
                'label' => 'Data determina',
                'format' => 'Y-m-d',
            ),
            'attributes' => array(
                'id'        => 'dataDetermina',
                'title'     => "Seleziona data determina",
            )
        ));
    }

    public function addImporti()
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'importiLabel',
            'attributes' => array(
                'id'    => 'importi_label',
                'value' => 'Importi',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'name' => 'importoAggiudicazione',
            'type' => 'Text',
            'options' => array('label' => '* Importo aggiudicazione (Euro): &euro;'),
            'attributes' => array(
                'id' => 'importoAggiudicazione',
                'title'         => "Inserisci l'importo aggiudicazione",
                'placeholder'   => 'Importo aggiudicazione...',
                'required'      => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'importoLiquidato',
            'type' => 'Text',
            'options' => array('label' => 'Importo delle somme liquidate (Euro): &euro;'),
            'attributes' => array(
                'id' => 'importoLiquidato',
                'title' => "Inserisci l'importo somme liquidate",
                'placeholder' => 'Importo somme liquidate...',
                'required' => 'required'
            ),
        ));
    }

    public function addStrutturaProponenteLabel()
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'struttura_label',
            'attributes' => array(
                'id'    => 'struttura_label',
                'value' => 'Struttura Proponente',
                'type'  => 'PlainTextTitle'
            ),
        ));
    }

    /**
     * @param array $records
     */
    public function addSettori($records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'settoreId',
            'options' => array(
                'label'         => 'Settore',
                'empty_option'  => 'Seleziona',
                'value_options' => $records,
            ),
            'attributes' => array(
                'title'     => 'Seleziona settore',
                'id'        => 'settoreId',
                'required'  => 'required'
            )
        ));
    }

    /**
     * Responsabile procedimento
     *
     * @param $records
     */
    public function addResponsabili($records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'respProcId',
            'options' => array(
                'label' => 'Responsabile',
                'empty_option' => 'Seleziona',
                'value_options' => $records,
            ),
            'attributes' => array(
                'title'     => 'Seleziona la struttura proponente',
                'id'        => 'respProcId',
                'required'  => 'required'
            )
        ));
    }

    public function addNumeroOfferte()
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
            'options' => array('label' => 'Numero di offerte ammesse'),
            'attributes' => array(
                'id'            => 'numeroOfferte',
                'title'         => "Inserisci numero di offerte ammesse",
                'placeholder'   => 'Offerte...',
                'required'      => 'required'
            ),
        ));
    }

    public function addDataInizioFineLavori()
    {
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
            'type' => 'DateTime',
            'name' => 'dataInizioLavori',
            'options' => array(
                'label' => 'Data inizio lavori',
                'format' => 'Y-m-d H:i:s',
            ),
            'attributes' => array(
                'id'        => 'dataInizioLavori',
                'required'  => 'required',
                'title'     => "Seleziona data inizio lavori",
            )
        ));

        $this->add(array(
            'type' => 'DateTime',
            'name' => 'dataFineLavori',
            'options' => array(
                'label' => 'Data fine lavori',
                'format' => 'Y-m-d H:i:s',
            ),
            'attributes' => array(
                'id'        => 'dataFineLavori',
                'required'  => 'required',
                'title'     => "Seleziona data fine lavori",
            )
        ));
    }

    /**
     * @param array $records
     */
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
            'name' => 'sceltaContraenteId',
            'options' => array(
                'label' => '* Scelta del contraente',
                'empty_option' => 'Seleziona',
                'value_options' => $records,
            ),
            'attributes' => array(
                'title'     => 'Seleziona la scelta del contraente',
                'id'        => 'sceltaContraenteId',
                'required'  => 'required'
            )
        ));
    }

    public function addDatePubblicazione()
    {
        $this->add(array(
            'type' => 'DateTime',
            'name' => 'dataInserimento',
            'options' => array(
                'label' => 'Data inserimento: l\'articolo sarà visibile sul sito a partire da questa data',
                'format' => 'Y-m-d H:i:s',
            ),
            'attributes' => array(
                'id'        => 'dataInserimento',
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

    /**
     * @param array $usersRecords
     */
    public function addUsersSelect($usersRecords)
    {
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
                        'name' => 'utenteId',
                        'options' => array(
                               'label' => 'Associa articolo a utente',
                               'value_options' => $usersRecords,
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona utente',
                                'id'    => 'utenteId'
                        )
        ));
    }
}