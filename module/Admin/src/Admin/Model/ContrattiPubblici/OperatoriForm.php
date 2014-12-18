<?php

namespace Admin\Model\ContrattiPubblici;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  18 December 2014
 */
class OperatoriForm extends Form
{
    public function __construct($name = null, $options = array())
    {        
        parent::__construct($name, $options);
                
        $this->add(array(
                        'name' => 'nome',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome' ),
                        'attributes' => array(
                                        'id' => 'nome',
                                        'title' => 'Inserisci nuova scelta contraente',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'cf',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Codice fiscale' ),
                        'attributes' => array(
                                        'id' => 'cf',
                                        'placeholder' => 'Codice fiscale...',
                                        'title' => 'Inserisci codice fiscale operatore',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'ragioneSociale',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Ragione sociale' ),
                        'attributes' => array(
                                        'id' => 'cf',
                                        'placeholder' => 'Ragione sociale...',
                                        'title' => 'Inserisci ragione sociale operatore',
                        ),
        ));
    }
}