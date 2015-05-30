<?php

namespace ModelModule\Model\EntiTerzi;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class EntiTerziForm extends Form
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
                        'options' => array('label' => '* Nome'),
                        'attributes' => array(
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nome...',
                                    'title' => 'Inserisci il nome',
                                    'id' => 'nome',
                        )
        ));

        $this->add(array(
                        'name' => 'email',
                        'type' => 'Email',
                        'options' => array( 'label' => '* Email' ),
                        'attributes' => array(
                                    'required'      => 'required',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Email...',
                                    'title'         => 'Inserisci email ente terzo',
                                    'id'            => 'email',
                        )
        ));

        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}
