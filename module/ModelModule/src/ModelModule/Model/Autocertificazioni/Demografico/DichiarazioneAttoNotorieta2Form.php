<?php

namespace ModelModule\Model\Autocertificazioni\Demografico;

use ModelModule\Model\Autocertificazioni\AutocertificazioniFormAbstract;

class DichiarazioneAttoNotorieta2Form extends AutocertificazioniFormAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'dichiara',
            'type' => 'Textarea',
            'options' => array('label' => 'Dichiara'),
            'attributes' => array(
                'id'            => 'dichiara',
                'title'         => 'Inserisci dichiarazione',
                'placeholder'   => 'Dichiarazione...',
                'rows'          => 8,
                'cols'          => 8
            ),
        ));

        $this->add(array(
            'name' => 'luogodichiarazione',
            'type' => 'Text',
            'options' => array('label' => 'Luogo'),
            'attributes' => array(
                'id'            => 'luogodichiarazione',
                'title'         => 'Luogo',
                'placeholder'   => 'Luogo...',
                'maxlength'     => '100',
            ),
        ));

        $this->add(array(
            'name' => 'datadichiarazione',
            'type' => 'Text',
            'options' => array('label' => 'Data'),
            'attributes' => array(
                'id'            => 'datadichiarazione',
                'title'         => 'Data',
                'placeholder'   => 'Data...',
                'maxlength'     => '100',
            ),
        ));

        $this->add(array(
            'name' => 'firma',
            'type' => 'Text',
            'options' => array('label' => 'Firma'),
            'attributes' => array(
                'id'            => 'firma',
                'title'         => 'Firma dichiarazione',
                'placeholder'   => 'Firma...',
                'maxlength'     => '180',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Compila modello',
                'id' => 'submit',
            ),
        ));
    }
}
