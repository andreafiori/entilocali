<?php

namespace Admin\Model\ContrattiPubblici;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  18 December 2014
 */
class OperatoriForm extends Form
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
                                        'placeholder' => 'Nome...',
                                        'title' => 'Inserisci nuova operatore',
                                        'required' => 'required'
                        ),
        ));
        
        $this->add(array(
                        'name' => 'cf',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Codice fiscale' ),
                        'attributes' => array(
                                        'id' => 'cf',
                                        'placeholder' => 'Codice fiscale...',
                                        'title'       => 'Inserisci codice fiscale operatore',
                                        'required'    => 'required'
                        ),
        ));
        
        $this->add(array(
                        'name' => 'ragioneSociale',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Ragione sociale' ),
                        'attributes' => array(
                                        'id'            => 'ragioneSociale',
                                        'placeholder'   => 'Ragione sociale...',
                                        'title'         => 'Inserisci ragione sociale operatore',
                                        'required'      => 'required'
                        ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class" => 'hiddenField')
        ));
    }
}