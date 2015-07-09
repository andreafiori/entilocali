<?php

namespace ModelModule\Model\AttiConcessione;

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
            'name' => 'attiConcessioneColonna',
            'attributes' => array(
                'title'     => 'Visualizza allegati nella colonna...',
                'id'        => 'attiConcessioneColonna',
                'required'  => 'required'
            ),
            'options' => array(
                'label' => '',
                'empty_option' => 'Nessuna',
                'value_options' => array(
                    1 => 'Progetto - Capitolato - Contratto - Curriculum',
                    2 => "Norma o Titolo a base dell'attribuzione",
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array('class' => 'hiddenField')
        ));
    }

    public function addSubmitButton()
    {
        $this->add(array(
                'name' => 'sbmt',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => '&nbsp;',
                    'value' => 'OK',
                    'id' => 'sbmt'
                ))
        );
    }
}