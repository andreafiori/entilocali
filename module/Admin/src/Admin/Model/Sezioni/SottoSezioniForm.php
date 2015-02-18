<?php

namespace Admin\Model\Sezioni;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 February 2015
 */
class SottoSezioniForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array( 'label' => '* Nome' ),
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Nome...',
                'title' => 'Inserisci nome sotto sezione',
                'id' => 'nome',
            )
        ));
    }
}