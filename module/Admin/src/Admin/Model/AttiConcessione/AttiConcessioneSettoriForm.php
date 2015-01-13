<?php

namespace Admin\Model\AttiConcessione;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  11 January 2015
 */
class AttiConcessioneSettoriForm extends Form
{
    /**
     * {@inheritDoc}
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'nome',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome' ),
                        'attributes' => array(
                                        'title'         => 'Inserisci il nome',
                                        'required'      => 'required',
                                        'placeholder'   => 'Nome...',
                                        'id'            => 'nome',
                        )
        ));
        
        $this->add(array(
                        'name' => 'responsabile',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Responsabile' ),
                        'attributes' => array(
                                        'title'         => 'Inserisci il nome responsabile',
                                        'required'      => 'required',
                                        'placeholder'   => 'Responsabile...',
                                        'id'            => 'responsabile',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'attivo',
                        'options' => array(
                               'label' => '* Stato',
                               'empty_option' => 'Seleziona',
                               'value_options' => array(
                                    '1'     => 'Attivo',
                                    '0'     => 'Nascosto',
                                ),
                        ),
                        'attributes' => array(
                                'title'         => 'Seleziona stato',
                                'required'      => 'required',
                                'id'            => 'stato'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}