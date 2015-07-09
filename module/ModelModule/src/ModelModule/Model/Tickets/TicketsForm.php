<?php

namespace ModelModule\Model\Tickets;

use Zend\Form\Form;

class TicketsForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = null)
    {
        parent::__construct($name);
        
        $this->add(array( 
            'name' => 'subject',
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder'   => 'Oggetto...',
                'title'         => "Inserisci l'oggetto del problema",
                'required'      => 'required',
                'id'            => 'subject'
            ),
            'options' => array( 
                'label' => '* Oggetto',
            ), 
        ));
        
        $this->add(array(
            'name' => 'message',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'placeholder'   => 'Descrizione...',
                'title'         => 'Inserisci descrizione problema',
                'required'      => 'required',
                'rows'          => 8,
                'id'            => 'message'
            ),
            'options' => array( 
                'label' => '* Descrizione',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'priority',
            'options' => array(
                'label' => "* Priorit&agrave;",
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    'alta'   => 'Alta',
                    'media'  => 'Media',
                    'bassa'  => 'Bassa',
                ),
            ),
            'attributes' => array(
                'required' => 'required',
                'title'    => 'Seleziona priorita',
                'id'       => 'priority'
            )
        ));
    }
}
