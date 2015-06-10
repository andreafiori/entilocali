<?php

namespace ModelModule\Model\Contenuti;

use Zend\Form\Form;

class ContenutiTabellaForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Textarea',
            'name' => 'tabella',
            'options' => array(
                'label' => '* Testo',
            ),
            'attributes' => array(
                'title'         => 'Inserisci testo tabella',
                'id'            => 'tabella',
                'required'      => 'required',
                'placeholder'   => 'Testo...',
                'class'         => 'wysiwyg',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array(
                "class" => 'hiddenField',
                'required' => 'required',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'titolo',
            'attributes' => array(
                "class" => 'hiddenField',
                'required' => 'required',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 6000
                )
            )
        ));
    }
}
