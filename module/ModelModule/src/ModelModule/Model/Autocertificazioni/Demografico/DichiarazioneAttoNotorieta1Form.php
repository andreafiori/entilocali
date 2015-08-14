<?php

namespace ModelModule\Model\Autocertificazioni\Demografico;

use Zend\Form\Form;

class DichiarazioneAttoNotorieta1Form extends Form
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
                'id'            => 'cognome',
                'title'         => 'Inserisci cognome',
                'placeholder'   => 'Cognome...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array('label' => 'Nome'),
            'attributes' => array(
                'id'            => 'nome',
                'title'         => 'Inserisci il nome',
                'placeholder'   => 'Nome...',
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
            'name' => 'luogonascita',
            'type' => 'Text',
            'options' => array('label' => 'Nato\a a'),
            'attributes' => array(
                'id'            => 'luogonascita',
                'title'         => 'Inserisci luogo di nascita',
                'placeholder'   => 'Luogo...',
                'maxlength'     => '220',
            ),
        ));

        $this->add(array(
            'name' => 'statonascita',
            'type' => 'Text',
            'options' => array('label' => 'Stato'),
            'attributes' => array(
                'id'            => 'statonascita',
                'title'         => 'Inserisci Stato di nascita',
                'placeholder'   => 'Stato...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'provincianascita',
            'type' => 'Text',
            'options' => array('label' => 'Provincia'),
            'attributes' => array(
                'id'            => 'provincianascita',
                'title'         => 'Inserisci provincia di nascita',
                'placeholder'   => 'Provincia...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'datanascita',
            'type' => 'Text',
            'options' => array('label' => 'Data nascita'),
            'attributes' => array(
                'id'            => 'datanascita',
                'title'         => 'Inserisci data nascita',
                'placeholder'   => 'Data...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'luogoresidenza',
            'type' => 'Text',
            'options' => array('label' => 'Residente a'),
            'attributes' => array(
                'id'            => 'luogoresidenza',
                'title'         => 'Inserisci luogo residenza',
                'placeholder'   => 'Residenza...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'provinciaresidenza',
            'type' => 'Text',
            'options' => array('label' => 'Provincia'),
            'attributes' => array(
                'id'            => 'provinciaresidenza',
                'title'         => 'Inserisci provincia residenza',
                'placeholder'   => 'Provincia...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'indirizzoresidenza',
            'type' => 'Text',
            'options' => array('label' => 'Indirizzo'),
            'attributes' => array(
                'id'            => 'indirizzoresidenza',
                'title'         => 'Inserisci luogo residenza',
                'placeholder'   => 'Indirizzo...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'numeroresidenza',
            'type' => 'Text',
            'options' => array('label' => 'Numero'),
            'attributes' => array(
                'id'            => 'numeroresidenza',
                'title'         => 'Inserisci numero residenza',
                'placeholder'   => 'Numero...',
                'maxlength'     => '100',
            ),
        ));

        /* Genitore */
        $this->add(array(
            'name' => 'cognomegenitore',
            'type' => 'Text',
            'options' => array('label' => 'Cognome'),
            'attributes' => array(
                'id'            => 'cognomegenitore',
                'title'         => 'Inserisci cognome',
                'placeholder'   => 'Cognome...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'nomegenitore',
            'type' => 'Text',
            'options' => array('label' => 'Nome'),
            'attributes' => array(
                'id'            => 'nomegenitore',
                'title'         => 'Inserisci il nome',
                'placeholder'   => 'Nome...',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'sessogenitore',
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
            'name' => 'luogonascitagenitore',
            'type' => 'Text',
            'options' => array('label' => 'Nato\a a'),
            'attributes' => array(
                'id'            => 'luogonascita',
                'title'         => 'Inserisci luogo di nascita',
                'placeholder'   => 'Luogo...',
                'maxlength'     => '220',
            ),
        ));

        $this->add(array(
            'name' => 'statonascitagenitore',
            'type' => 'Text',
            'options' => array('label' => 'Stato'),
            'attributes' => array(
                'id'            => 'statonascita',
                'title'         => 'Inserisci Stato di nascita',
                'placeholder'   => 'Stato...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'provincianascitagenitore',
            'type' => 'Text',
            'options' => array('label' => 'Provincia'),
            'attributes' => array(
                'id'            => 'provincianascitagenitore',
                'title'         => 'Inserisci provincia di nascita',
                'placeholder'   => 'Provincia...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'datanascitagenitore',
            'type' => 'Text',
            'options' => array('label' => 'Data nascita'),
            'attributes' => array(
                'id'            => 'datanascitagenitore',
                'title'         => 'Inserisci data nascita',
                'placeholder'   => 'Data...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'luogoresidenzagenitore',
            'type' => 'Text',
            'options' => array('label' => 'Residente a'),
            'attributes' => array(
                'id'            => 'luogoresidenzagenitore',
                'title'         => 'Inserisci luogo residenza',
                'placeholder'   => 'Residenza...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'provinciaresidenzagenitore',
            'type' => 'Text',
            'options' => array('label' => 'Provincia'),
            'attributes' => array(
                'id'            => 'luogoresidenzagenitore',
                'title'         => 'Inserisci provincia residenza',
                'placeholder'   => 'Provincia...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'indirizzoresidenzagenitore',
            'type' => 'Text',
            'options' => array('label' => 'Indirizzo'),
            'attributes' => array(
                'id'            => 'indirizzoresidenzagenitore',
                'title'         => 'Inserisci luogo residenza',
                'placeholder'   => 'Indirizzo...',
                'maxlength'     => '200',
            ),
        ));

        $this->add(array(
            'name' => 'numeroresidenzagenitore',
            'type' => 'Text',
            'options' => array('label' => 'Numero'),
            'attributes' => array(
                'id'            => 'numeroresidenzagenitore',
                'title'         => 'Inserisci numero residenza',
                'placeholder'   => 'Numero...',
                'maxlength'     => '100',
            ),
        ));

        /* Dichiara */
        $this->add(array(
            'name' => 'dichiara',
            'type' => 'Textarea',
            'options' => array('label' => 'Dichiara'),
            'attributes' => array(
                'id'            => 'numeroresidenzagenitore',
                'title'         => 'Inserisci numero residenza',
                'placeholder'   => 'Numero...',
                'maxlength'     => '100',
            ),
        ));

        $this->add(array(
            'name' => 'luogodichiarazione',
            'type' => 'Text',
            'options' => array('label' => 'Numero'),
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

        /* CSRF */
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3200
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