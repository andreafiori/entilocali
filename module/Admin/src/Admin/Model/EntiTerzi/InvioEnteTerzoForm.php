<?php

namespace Admin\Model\EntiTerzi;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  22 September 2014
 */
class InvioEnteTerzoForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
                        'name' => 'title',
                        'type' => 'Email',
                        'options' => array( 'label' => "* Indirizzo email ente" ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'placeholder' => 'Email ente',
                                        'title' => 'Inserisci indirizzo email ente a cui inviare',
                                        'id' => 'title',
                        )
        ));
    }
    
    /**
     * Multi checkbox with enti terzi records
     * 
     * @param array|null $records
     */
    public function addContatti($records)
    {
        if (is_array($records)) {

            $optionsValue = array();
            foreach($records as $record) {
                $optionsValue[] = $record['nome'].' ('.$record['email'].')';
            }
            
            $this->add(array(
                'type' => 'MultiCheckbox',
                'name' => 'entiterzi',
                'options' => array(
                    'label' => 'Ente',
                    'value_options' => $optionsValue,
                ),
                'attributes' => array(
                    'id' => 'entiterzi',
                ),
            ));
        }
    }
}
