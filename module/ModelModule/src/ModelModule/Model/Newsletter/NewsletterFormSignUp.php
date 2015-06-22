<?php

namespace ModelModule\Model\Newsletter;

use Zend\Form\Form;

/**
 * Subscribe \ Unsubscribe form for the public website
 */
class NewsletterFormSignUp extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array( 
            'name' => 'email', 
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array( 
                'placeholder' => 'Inserisci email',
                'title'     => 'Inserisci email',
                'required'  => 'required',
                'id'        => 'nome',
                'maxlength' => '150',
            ), 
            'options' => array(
                'label' => 'Nome', 
            ), 
        ));
        
        $this->add(array(
             'type' => 'Zend\Form\Element\Radio',
             'name' => 'subscribe_unsubscribe',
             'options' => array(
                     'label' => 'Stato',
                     'value_options' => array(
                            'subscribe'   => 'Iscriviti',
                            'unsubscribe' => 'Cancellati',
                     ),
                    'checked_value' => 'subscribe',
             )
        ));
    }
}
