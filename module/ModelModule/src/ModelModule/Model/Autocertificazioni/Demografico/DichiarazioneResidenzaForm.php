<?php

namespace ModelModule\Model\Autocertificazioni\Demografico;

use Zend\Form\Form;

class DichiarazioneResidenzaForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'scelta',
            'options' => array(
                'label' => '',
                'value_options' => array(
                    '1' => 'Dichiarazione di residenza con provenienza da un altro Comune.',
                    '2' => "Dichiarazione di residenza con provenienza dall'estero.",
                    '3' => "Dichiarazione di residenza di cittadini Italiani iscritti all'AIRE (Anagrafe degli Italiani residenti all'estero) con provenienza dall'estero. Indicare lo stato estero di provenienza e il comune di iscrizione AIRE:",
                    '4' => "Dichiarazione di cambiamento di abitazione nell'ambito dello stesso comune",
                    '5' => "Iscrizione per altro motivo. Specificare il motivo",
                ),
            ),
        ));

        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array('label' => '* Nome'),
            'attributes' => array(
                'id'            => 'nome',
                'title'         => 'Inserisci nome',
                'placeholder'   => 'Nome...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'cognome',
            'type' => 'Text',
            'options' => array('label' => '* Cognome'),
            'attributes' => array(
                'id'            => 'cognome',
                'title'         => 'Inserisci cognome',
                'placeholder'   => 'Cognome...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'datanascita',
            'type' => 'Text',
            'options' => array('label' => 'Data di nascita'),
            'attributes' => array(
                'id'            => 'datanascita',
                'title'         => 'Inserisci data nascita',
                'placeholder'   => 'Data...',
                'maxlength'     => '100',
            ),
        ));

        $this->add(array(
            'name' => 'luogonascita',
            'type' => 'Text',
            'options' => array('label' => 'Luogo di nascita'),
            'attributes' => array(
                'id'            => 'luogonascita',
                'title'         => 'Inserisci luogoo di nascita',
                'placeholder'   => 'Luogo...',
                'maxlength'     => '220',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'sesso',
            'options' => array(
                'label' => 'Sesso',
                'value_options' => array(
                    'M' => 'M',
                    'F' => "F",
                ),
            ),
            'attributes' => array(
                'value' => 'M',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'statocivile',
            'options' => array(
                'label' => 'Stato civile',
                'value_options' => array(
                    'celibe' => 'Celibe',
                    'nubile' => "Nubile",
                    'coniugato' => "Coniugato",
                ),
            ),
            'attributes' => array(
                'value' => 'celibe',
            ),
        ));

        $this->add(array(
            'type' => 'Text',
            'name' => 'cittadinanza',
            'options' => array(
                'label' => 'Cittadinanza',
            ),
            'attributes' => array(
                'id'            => 'cittadinanza',
                'title'         => 'Inserisci cittadinanza',
                'placeholder'   => 'Cittadinanza...',
            ),
        ));

        $this->add(array(
            'type' => 'Text',
            'name' => 'cf',
            'options' => array(
                'label' => 'C.F',
            ),
            'attributes' => array(
                'id'            => 'cf',
                'title'         => 'Inserisci codice fiscale',
                'placeholder'   => 'Codice fiscale...',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'posizioneprofessionale',
            'options' => array(
                'label' => 'Posizione professionale',
                'value_options' => array(
                    'imprenditore-libero-professionista' => 'Imprenditore / Libero professionista',
                    'dirigente-impiegato' => 'Dirigente / Impiegato',
                    'lavoratore-in-proprio' => 'Lavoratore in proprio',
                    'operaio-e-assimilati' => 'Operaio e assimilati',
                    'coadiuvante' => 'Coadiuvante',
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'posizionenonprofessionale',
            'options' => array(
                'label' => 'Posizione non professionale',
                'value_options' => array(
                    'casalinga' => 'Casalinga',
                    'studente' => 'Studente',
                    'disoccupato-in-cerca-di-prima-occupazione' => 'Disoccupato / in cerca di prima occupazione',
                    'pensionato-ritirato-dal-lavoro' => 'Pensionato / Ritirato dal lavoro',
                    'altra-condizione-non-professionale' => 'Altra condizione non professionale',
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'titolistudio',
            'options' => array(
                'label' => '',
                'value_options' => array(
                    'nessun-titolo-licenza elementare' => 'Nessun titolo / licenza elementare',
                    'licenza-media' => 'Licenza media',
                    'diploma' => 'Diploma',
                    'laurea-triennale' => 'Laurea triennale',
                    'laurea' => 'Laurea',
                    'dottorato' => 'Dottorato',
                ),
            ),
        ));

        /* Patente */
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sezione',
            'attributes' => array(
                'title' => '',
                'id'    => 'patentetipo'
            ),
            'options' => array(
                'label' => 'Sezione',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'D' => 'D',
                    'B+E' => 'B+E',
                    'C+E' => 'C+E',
                    'D+E' => 'D+E',
                    'patente-disabili' => 'Patente spciale per disabile',
                    /*
                    'AM' => 'AM',
                    'A1' => 'A1',
                    'A2' => 'A2',
                    'A3' => 'A3',
                    'A' => 'A',
                    'B1' => 'B1',
                    'B' => 'B',
                    'B96' => 'B96',
                    'BE' => 'BE',
                    'C1' => 'C1',
                    'C1E' => 'C1E',
                    'CE' => 'CE',
                    'D1' => 'D1',
                    'D1E' => 'D1E',
                    'D' => 'D',
                    'DE' => 'DE',
                    'E' => 'E',
                    'KA' => 'KA',
                    'KB' => 'KB',
                    'CQC-Persone' => 'CQC Persone',
                    'CQC-Merci' => 'CQC Merci',
                    'CFP' => 'Patentino CFP ADR –tipo B, A,B+esplosivi,B+radioattivi',
                    */
                ),
            )
        ));

        // Patente tipo, Numero

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
}