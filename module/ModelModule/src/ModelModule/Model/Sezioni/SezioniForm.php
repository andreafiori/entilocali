<?php

namespace ModelModule\Model\Sezioni;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;

class SezioniForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array( 'label' => '* Nome' ),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Nome...',
                'title'         => 'Inserisci nome sezione',
                'id'            => 'nome',
                'maxlength'     => 230,
            )
        ));
    }

    /**
     * @param array $languages
     */
    public function addLingue(array $languages)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'lingua',
            'options' => array(
                'label' => '* Lingua',
                'empty_option'  => 'Seleziona',
                'value_options' => $languages,
            ),
            'attributes' => array(
                'required'  => 'required',
                'title'     => 'Seleziona lingua',
                'id'        => 'lingua'
            )
        ));
    }

    public function addIconImage()
    {
        $this->add(array(
            'name' => 'image',
            'type' => 'File',
            'options' => array('label' => 'Immagine icona'),
            'attributes' => array(
                'placeholder'   => 'Immagine...',
                'title'         => 'Inserisci icona immagine sezione',
                'id'            => 'image',
            )
        ));
    }

    public function addOptions()
    {
        $this->add(array(
            'name' => 'url',
            'type' => 'Text',
            'options' => array(
                'label' => 'Link:'
            ),
            'attributes' => array(
                'placeholder'  => 'Link...',
                'title'        => 'Inserisci nome sezione',
                'id'           => 'url',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'colonna',
            'options' => array(
                'label' => '* Colonna',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    'sx'   => 'Sinistra',
                    'dx'   => 'Destra',
                ),
            ),
            'attributes' => array(
                'required' => 'required',
                'title' => 'Seleziona colonna',
                'id'    => 'colonna'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'attivo',
            'options' => array(
                'label' => '* Stato',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    1 => 'Attivo',
                    0 => 'Nascosto',
                ),
            ),
            'attributes' => array(
                'required' => 'required',
                'title'    => 'Seleziona stato',
                'id'       => 'attivo'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'isAmmTrasparente',
            'attributes' => array(
                "class" => 'hiddenField',
                'id'    => 'isAmmTrasparente'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array(
                "class" => 'hiddenField',
                'id'    => 'id'
            )
        ));
    }

    public function addModule()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'modulo',
            'options' => array(
                'label' => '* Associa al modulo',
                'empty_option'  => 'Seleziona',
                'value_options' => array(
                    2   => 'Contenuti',
                    19  => 'Amministrazione trasparente',
                    10  => 'Blogs',
                    3   => 'Albo pretorio',
                    17  => 'Contratti pubblici',
                    15  => 'Atti concessione',
                    6   => 'Newsletter',
                    8   => 'Foto',
                    12  => 'Ricerca',

                ),
            ),
            'attributes' => array(
                'required'  => 'required',
                'title'     => 'Seleziona modulo',
                'id'        => 'lingua'
            )
        ));
    }

    public function addBlocco()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'blocco',
            'options' => array(
                'label' => 'Crea un blocco per questa sezione',
                'checked_value'   => 1,
                'unchecked_value' => 0
            ),
            'attributes' => array(
                'id'    => 'blocco',
                'title' => 'Spunta la casella per creare un blocco sulla sezione'
            )
        ));
    }
}
