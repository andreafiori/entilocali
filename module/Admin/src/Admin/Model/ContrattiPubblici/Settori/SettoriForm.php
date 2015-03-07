<?php

namespace Admin\Model\ContrattiPubblici\Settori;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  04 March 2015
 */
class SettoriForm extends Form
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
                'id' => 'nome',
                'title'     => 'Inserisci nome settore',
                'required'  => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'responsabile',
            'type' => 'Text',
            'options' => array( 'label' => '* Responsabile' ),
            'attributes' => array(
                'id'        => 'responsabile',
                'title'     => 'Inserisci nome responsabile',
                'required'  => 'required'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'attivo',
            'options' => array(
                'label' => '* Stato',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    1   => 'Attivo',
                    0   => 'Nascosto',
                ),
            ),
            'attributes' => array(
                'title'     => 'Seleziona stato',
                'id'        => 'attivo',
                'required'  => 'required'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class" => 'hiddenField')
        ));
    }
}