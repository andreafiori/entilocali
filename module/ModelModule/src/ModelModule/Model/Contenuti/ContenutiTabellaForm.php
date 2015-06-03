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
                "class" => 'hiddenField'
            )
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}
