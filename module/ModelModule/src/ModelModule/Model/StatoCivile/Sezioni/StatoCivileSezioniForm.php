<?php

namespace ModelModule\Model\StatoCivile\Sezioni;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class StatoCivileSezioniForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = 'formData', $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'nome',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id'            => 'nome',
                'placeholder'   => 'Nome...',
                'title'         => 'Inserisci nome sezione',
                'required'      => 'required',
                'maxlength'     => 250
            ),
            'options' => array(
                'label' => '* Nome',
            ),
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'attivo',
                        'options' => array(
                                'label' => '* Stato',
                                'empty_option' => 'Seleziona',
                                'value_options' => array(
                                       '1'   => 'Attivo',
                                       '0'   => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'required' => 'required',
                                'id'       => 'attivo',
                                'title'    => 'Seleziona stato',
                        )
        ));

        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}