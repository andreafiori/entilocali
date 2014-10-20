<?php

namespace Admin\Model\Entiterzi;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  22 September 2014
 */
class InvioEnteTerzoForm extends Form
{
    /**
     * 
     * @param string $name
     * @param string $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'title',
                        'type' => 'Text',
                        'options' => array( 'label' => "* Indirizzo email Ente" ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'placeholder' => 'Email ente',
                                        'title' => 'Inserisci indirizzo email ente a cui inviare',
                                        'id' => 'title',
                        )
        ));
        
        $this->add(array(
                        'name' => 'image',
                        'type' => 'Zend\Form\Element\File',
                        'options' => array( 'label' => 'File verbale di richiesta pubblicazioni in altro Ente:' ),
                        'attributes' => array(
                                        'title' => 'Allega file',
                                        'id' => 'image',
                        )
        ));
    }
}