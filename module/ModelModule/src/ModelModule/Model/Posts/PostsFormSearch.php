<?php

namespace ModelModule\Model\Posts;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class PostsFormSearch extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->add(array(
            'name' => 'testo',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'testo',
                'placeholder' => 'Testo...',
                'required'    => 'required',
                'title'       => 'Digita il testo da cercare'
            ),
            'options' => array(
                'label' => 'Testo',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }

    public function addCategories($categories)
    {
        $this->add(array(
            'name' => 'category',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'category',
                'title' => 'Seleziona categoria'
            ),
            'options' => array(
                'label' => 'Categoria',
                'value_options' => $categories,
                'empty_option' => 'Seleziona',
            ),
        ));
    }

    public function addSubmitButton()
    {
        $this->add(array(
                'name' => 'search',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => ' ',
                    'title' => "Premi per avviare la ricerca sui blogs",
                    'value' => 'Cerca',
                    'id'    => 'submit',
                ))
        );
    }
}