<?php

namespace Admin\Model\AttiConcessione;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class AttiConcessioneRespProcForm extends Form
{
    /**
     * @param string $name
     * @param string $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'nomeResp',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome' ),
                        'attributes' => array(
                                        'title'         => 'Inserisci il nome responsabile',
                                        'required'      => 'required',
                                        'placeholder'   => 'Nome...',
                                        'id'            => 'nomeResp',
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
                                'id'            => 'attivo'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}