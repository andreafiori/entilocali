<?php

namespace Admin\Model\AttiConcessione;

use Zend\Form\Form;

class AttiConcessioneColumnDisplayForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'mese',
            'attributes' => array(
                'title' => 'Visualizza allegati nella colonna...',
                'id'    => 'mese'
            ),
            'options' => array(
                'label' => '',
                'empty_option' => 'Nessuna',
                'value_options' => array(
                    '1' => 'Progetto - Capitolato - Contratto - Curriculum',
                    '2' => "Norma o Titolo a base dell'attribuzione",
                ),
            )
        ));
    }

    public function addSubmitButton()
    {
        $this->add(array(
                'name' => 'send',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => '&nbsp;',
                    'value' => 'OK',
                    'id' => 'send'
                ))
        );
    }
}