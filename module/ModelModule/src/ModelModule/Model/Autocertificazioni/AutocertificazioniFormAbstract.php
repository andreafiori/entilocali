<?php

namespace ModelModule\Model\Autocertificazioni;

use Zend\Form\Form;

/**
 * Autocertificazioni form common fields
 */
abstract class AutocertificazioniFormAbstract extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'cognome',
            'type' => 'Text',
            'options' => array('label' => 'Cognome'),
            'attributes' => array(
                'id' => 'cognome',
                'title' => 'Inserisci cognome',
                'placeholder' => 'Cognome...',
                'maxlength' => '200',
            ),
        ));

        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array('label' => 'Nome'),
            'attributes' => array(
                'id' => 'nome',
                'title' => 'Inserisci il nome',
                'placeholder' => 'Nome...',
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
            'name' => 'luogo_nascita',
            'type' => 'Text',
            'options' => array('label' => 'Nato\a a'),
            'attributes' => array(
                'id' => 'luogo_nascita',
                'title' => 'Inserisci luogo di nascita',
                'placeholder' => 'Luogo...',
                'maxlength' => '220',
            ),
        ));

        $this->add(array(
            'name' => 'stato_nascita',
            'type' => 'Text',
            'options' => array('label' => 'Stato'),
            'attributes' => array(
                'id' => 'stato_nascita',
                'title' => 'Inserisci Stato di nascita',
                'placeholder' => 'Stato...',
                'maxlength' => '200',
            ),
        ));

        $this->add(array(
            'name' => 'provincia_nascita',
            'type' => 'Text',
            'options' => array('label' => 'Provincia'),
            'attributes' => array(
                'id' => 'provincia_nascita',
                'title' => 'Inserisci provincia di nascita',
                'placeholder' => 'Provincia...',
                'maxlength' => '200',
            ),
        ));

        $this->add(array(
            'name' => 'data_nascita',
            'type' => 'Text',
            'options' => array('label' => 'Data nascita'),
            'attributes' => array(
                'id' => 'datanascita',
                'title' => 'Inserisci data nascita',
                'placeholder' => 'Data...',
                'maxlength' => '200',
            ),
        ));

        $this->add(array(
            'name' => 'luogo_residenza',
            'type' => 'Text',
            'options' => array('label' => 'Residente a'),
            'attributes' => array(
                'id' => 'luogoresidenza',
                'title' => 'Inserisci luogo residenza',
                'placeholder' => 'Residenza...',
                'maxlength' => '200',
            ),
        ));

        $this->add(array(
            'name' => 'provincia_residenza',
            'type' => 'Text',
            'options' => array('label' => 'Provincia'),
            'attributes' => array(
                'id' => 'provinciaresidenza',
                'title' => 'Inserisci provincia residenza',
                'placeholder' => 'Provincia...',
                'maxlength' => '200',
            ),
        ));

        $this->add(array(
            'name' => 'indirizzo_residenza',
            'type' => 'Text',
            'options' => array('label' => 'Indirizzo'),
            'attributes' => array(
                'id' => 'indirizzoresidenza',
                'title' => 'Inserisci luogo residenza',
                'placeholder' => 'Indirizzo...',
                'maxlength' => '200',
            ),
        ));

        $this->add(array(
            'name' => 'numero_residenza',
            'type' => 'Text',
            'options' => array('label' => 'Numero'),
            'attributes' => array(
                'id' => 'numeroresidenza',
                'title' => 'Inserisci numero residenza',
                'placeholder' => 'Numero...',
                'maxlength' => '100',
            ),
        ));

        /* Dichiarazione, Data, luogo e firma */
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
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 5600
                )
            )
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
