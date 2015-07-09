<?php

namespace ModelModule\Model\SearchEngine;

use Zend\Form\Form;

/**
 * Search engine form
 */
class SearchEngineForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'searchtext',
            'type' => 'Text',
            'options' => array( 'label' => '* Nome' ),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Cerca...',
                'title'         => 'Inserisci nome sezione',
                'id'            => 'searchtext',
                'maxlength'     => 230,
            )));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3200
                )
            )
        ));
    }
}