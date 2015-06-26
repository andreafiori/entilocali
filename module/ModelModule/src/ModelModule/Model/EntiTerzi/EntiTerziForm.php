<?php

namespace ModelModule\Model\EntiTerzi;

use Zend\Form\Form;

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
                        'name' => 'freeText',
                        'type' => 'Textarea',
                        'options' => array( 'label' => '* Email' ),
                        'attributes' => array(
                                    'required'      => 'required',
                                    'placeholder'   => 'Testo...',
                                    'title'         => 'Inserisci testo libero home page',
                                    'id'            => 'freeText',
                                    'maxlength'     => 230,
                                    'class'         => 'wysiwyg',
                        )
        ));

        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}
