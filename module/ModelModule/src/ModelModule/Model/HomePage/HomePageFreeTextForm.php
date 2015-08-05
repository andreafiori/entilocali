<?php

namespace ModelModule\Model\HomePage;

use Zend\Form\View\Helper\Form;

class HomePageFreeTextForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array('label' => '* Nome'),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Titolo...',
                'title'         => 'Inserisci il titolo',
                'id'            => 'title',
            )
        ));



        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class" => 'hiddenField')
        ));
    }
}