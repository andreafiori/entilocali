<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use Zend\Form\Form;

class OperatoriAggiudicatariRuoloForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {        
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'relationId',
            'attributes' => array("class" => 'hiddenField')
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ruolo',
            'options' => array(
                'label' => '* Ruolo',
                'empty_option'  => 'Seleziona',
                'value_options' => array(
                    1 => 'Mandante',
                    2 => 'Mandataria',
                    3 => 'Associata',
                    4 => 'Capogruppo',
                    5 => 'Consorziata',
                ),
            ),
            'attributes' => array(
                'title'     => 'Seleziona ruolo',
                'id'        => 'ruolo',
                'required'  => 'required',
            )
        ));
    }

    public function addSubmitButton()
    {
        $this->add(array(
                'name' => 'okRole',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => '&nbsp;',
                    'value' => 'OK',
                    'id'    => 'okRole'
                ))
        );
    }
}