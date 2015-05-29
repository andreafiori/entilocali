<?php

namespace Admin\Model\Contenuti;

use Zend\Form\Form;

class ContenutiFormSearch extends Form
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

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'languageSelection',
            'attributes' => array(
                'class'     => 'hiddenField',
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

    /**
     * @param $sottoSezioni
     */
    public function addSottosezioni($sottoSezioni)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sottosezioni',
            'attributes' => array(
                'title' => 'Seleziona sottosezioni',
                'id'    => 'sottosezioni'
            ),
            'options' => array(
                'label' => 'Sottosezioni',
                'empty_option' => 'Seleziona',
                'value_options' => $sottoSezioni,
            )
        ));
    }

    /**
     * @param array $userRecords
     */
    public function addUsers(array $userRecords)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'utente',
            'options' => array(
                'label' => '* Utente',
                'empty_option' => 'Seleziona',
                'value_options' => $userRecords,
            ),
            'attributes' => array(
                'title'     => 'Seleziona utente',
                'id'        => 'utente',
                'required'  => 'required'
            )
        ));
    }

    public function addInHome()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'inhome',
            'options' => array(
                'label'             => 'presente in home page',
                'checked_value'     => 1,
                'unchecked_value'   => 0,
            ),
            'attributes' => array(
                'id'    => 'inhome',
                'title' => "Contenuti in home page"
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
