<?php

namespace ModelModule\Model\Tickets;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  14 May 2014
 */
class TicketsForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
        
        $this->add(array( 
            'name' => 'oggetto', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Oggetto...',
                'title' => "Inserisci l'oggetto del problema",
                'required' => 'required',
                'id' => 'oggetto'
            ),
            'options' => array( 
                'label' => 'Oggetto',
            ), 
        ));
        
        $this->add(array( 
            'name' => 'descrizione', 
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'placeholder' => 'Inserisci descrizione...',
                'title' => 'Inserisci descrizione',
                'required' => 'required',
                'rows' => 8,
                'id' => 'descrizione'
            ),
            'options' => array( 
                'label' => 'Descrizione',
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
                'title'    => 'Seleziona piorita',
                'id'       => 'priority'
            )
        ));
    }
}
