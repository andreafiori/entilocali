<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use Zend\Form\Form;

class OperatoriForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {        
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class" => 'hiddenField')
        ));

        $this->add(array(
                        'name' => 'nome',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome' ),
                        'attributes' => array(
                                        'id'            => 'nome',
                                        'placeholder'   => 'Nome...',
                                        'title'         => 'Inserisci nome',
                                        'required'      => 'required'
                        ),
        ));
        
        $this->add(array(
                        'name' => 'cf',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Codice fiscale' ),
                        'attributes' => array(
                                        'id' => 'cf',
                                        'placeholder' => 'Codice fiscale...',
                                        'title'       => 'Inserisci codice fiscale',
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
                                        'title'         => 'Inserisci ragione sociale',
                                        'required'      => 'required'
                        ),
        ));
    }
}