<?php

namespace Admin\Model\StatoCivile;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 June 2014
 */
class StatoCivileForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct('formData', $options);
        
        $this->add(array(
                        'name' => 'nome',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Nome' ),
                        'attributes' => array(
                                        'id'       => 'nome',
                                        'required' => 'required',
                        )
        ));
    }
}