<?php

namespace ModelModule\Model\AttiConcessione\ModalitaAssegnazione;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  30 March 2015
 */
class AttiConcessioneModalitaAssegnazioneForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = null)
    {
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class"=>'hiddenField')
        ));

        $this->add(array(
            'name' => 'nome',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Inserisci nome...',
                'title'         => 'Inserisci nome',
                'required'      => 'required',
                'id'            => 'nome'
            ),
            'options' => array(
                'label' => 'Nome',
            ),
        ));
    }
}