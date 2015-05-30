<?php

namespace ModelModule\Model\AlboPretorio;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class AlboPretorioSezioniForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'nome',
                        'options' => array(
                               'label' => 'Nome',
                        ),
                        'attributes' => array(
                                'title'         => 'Inserisci nome sezione',
                                'id'            => 'nome',
                                'required'      => 'required',
                                'placeholder'   => 'Inserisci nome sezione...',
                        )
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