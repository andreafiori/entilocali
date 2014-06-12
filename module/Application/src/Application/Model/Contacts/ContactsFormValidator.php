<?php

namespace Application\Model\Contacts;

use Zend\InputFilter\InputFilter;

/**
 * Contact Form Validator
 * 
 * @author Andrea Fiori
 * @since  21 April 2014
 */
class ContactsFormValidator extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'nome',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),       
        ));

        $this->add(array(
            'name' => 'cognome',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),           
        ));
        
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                ),
            ),            
        ));  
    }
}