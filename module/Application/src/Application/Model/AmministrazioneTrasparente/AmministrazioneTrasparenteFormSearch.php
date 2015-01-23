<?php

namespace Application\Model\AmministrazioneTrasparente;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class AmministrazioneTrasparenteFormSearch extends Form 
{
    /**
     * {@inheritDoc}
     */
    public function __construct($name = null) 
    {
        parent::__construct('contactForm');

        $this->add(array(
                        'name' => 'anno',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Anno' ),
                        'attributes' => array(
                                        'title' => 'Anno di riferimento',
                                        'id'    => 'anno',
                                        'maxlength' => 4,
                                        'type' => 'Number'
                        )
        ));
        
        $this->add(array(
                        'name' => 'testo',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Testo' ),
                        'attributes' => array(
                                        'title' => 'Inserisci il testo',
                                        'id'    => 'testo',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Checkbox',
                        'name' => 'subsection',
                        'options' => array(
                                'label' => 'Cerca nelle sottosezioni',
                                'use_hidden_element' => false,
                                'checked_value'     => 1,
                                'unchecked_value'   => 0
                        ),
                        'attributes' => array(
                                'id' => 'subsection'
                        )
        ));
        
        $this->add(array(
                        'name' => 'search',
                        'type' => 'Submit',
                        'options' => array( 'label' => '&nbsp;' ),
                        'attributes' => array(
                                        'title' => 'Avvia ricerca',
                                        'id'    => 'search',
                                        'value' => 'Cerca',
                        )
        ));
    }
}