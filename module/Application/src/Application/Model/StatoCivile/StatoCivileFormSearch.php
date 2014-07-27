<?php

namespace Application\Model\StatoCivile;

use Zend\Form\Form;

/**
 * Stato Civile Frontend Search Form
 * 
 * @author Andrea Fiori
 * @since  24 July 2014
 */
class StatoCivileFormSearch extends Form
{
    /**
     * @param type $name
     * @param type $options
     */
    public function __construct($name = null, $options = array()) {
        
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Text',
            'name' => 'testo',
            'attributes' => array(
                'title'  => 'Inserisci testo...',
                'id'     => 'testo'
            ),
            'options' => array(
                'label' => 'Testo',
            )
        ));
    }
    
    public function addSezioni()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sezione',
            'attributes' => array(
                'title' => 'Seleziona sezione',
                'id'    => 'sezione'
            ),
            'options' => array(
                    'label' => 'Sezione',
                    'value_options' => array(
                        '' => 'Sezione',
                    ),
            )
        ));
    }
    
    public function addSubmitButton()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                    'csrf_options' => array(
                            'timeout' => 600
                    )
            )
        ));
        
        $this->add(array(
            'name' => 'search',
            'type'  => 'submit',
            'attributes' => array(
                'label' => '&nbsp;',
                'value' => 'Cerca',
            ))
        );
    }
}
