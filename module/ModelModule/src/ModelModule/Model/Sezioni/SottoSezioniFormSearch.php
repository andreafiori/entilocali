<?php

namespace ModelModule\Model\Sezioni;

use Zend\Form\Form;

class SottoSezioniFormSearch extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = null)
    {
        parent::__construct($name);

        $this->add(array(
            'type' => 'Text',
            'name' => 'testo',
            'attributes' => array(
                'placeholder'   => 'Testo...',
                'title'         => 'Inserisci testo',
                'id'            => 'testo',
            ),
            'options' => array(
                'label' => 'Testo',
            )
        ));
    }

    /**
     * @param $sezioni
     */
    public function addSezioni($sezioni)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sezioni',
            'attributes' => array(
                'title' => 'Seleziona sezioni',
                'id'    => 'sezioni'
            ),
            'options' => array(
                'label' => 'Sezioni',
                'empty_option' => 'Seleziona',
                'value_options' => $sezioni,
            )
        ));
    }

    public function addSubmitButton()
    {
        $this->add(array(
                'name' => 'search',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => '&nbsp;',
                    'title' => "Premi per avviare la ricerca",
                    'value' => 'Cerca',
                    'id'    => 'submit',
                ))
        );
    }
}