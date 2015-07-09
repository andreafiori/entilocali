<?php

namespace ModelModule\Model\EntiTerzi;

use Zend\Form\Form;

/**
 * Enti Terzi Form
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
                                    'required'      => 'required',
                                    'placeholder'   => 'Nome...',
                                    'title'         => 'Inserisci il nome',
                                    'id'            => 'nome',
                                    'maxlength'     => 230,
                        )
        ));

        $this->add(array(
                        'name' => 'email',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Email' ),
                        'attributes' => array(
                                    'required'      => 'required',
                                    'placeholder'   => 'Email...',
                                    'title'         => 'Inserisci email',
                                    'id'            => 'email',
                                    'maxlength'     => 230,
                        )
        ));

        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}
