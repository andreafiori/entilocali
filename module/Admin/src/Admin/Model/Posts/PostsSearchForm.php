<?php

namespace Admin\Model\Posts;

use Zend\Form\Form;

/**
 * Backend Search \ Filter form
 */
class PostsSearchForm extends Form
{
    public function addCategories($sezioni)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'categoryId',
            'options' => array(
                'label'         => '* Categoria',
                'empty_option'  => 'Categoria',
                'value_options' => $sezioni,
            ),
            'attributes' => array(
                'title'     => 'Seleziona categoria',
                'id'        => 'categoryId',
                'required'  => 'required',
            )
        ));
    }
}