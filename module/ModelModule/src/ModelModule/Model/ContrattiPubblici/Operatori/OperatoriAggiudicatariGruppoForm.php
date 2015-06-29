<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use Zend\Form\Form;

class OperatoriAggiudicatariGruppoForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'partecipanteId',
            'attributes' => array("class" => 'hiddenField')
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'contrattoId',
            'attributes' => array("class" => 'hiddenField')
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'relationId',
            'attributes' => array("class" => 'hiddenField')
        ));

        $this->add(array(
                        'name' => 'gruppo',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Gruppo' ),
                        'attributes' => array(
                                        'id'          => 'gruppo',
                                        'title'       => 'Inserisci codice fiscale',
                                        'required'    => 'required',
                                        // 'type'     => 'number',
                                        'size'        => 1
                        ),
        ));
    }

    public function addSubmitButton()
    {
        $this->add(array(
                'name' => 'okGroup',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => '&nbsp;',
                    'value' => 'OK',
                    'id'    => 'okGroup'
                ))
        );
    }
}