<?php

namespace ModelModule\Model\Contenuti;

use Zend\Form\Form;

class ContenutiForm extends Form
{
    /**
     * @param array|null $records
     */
    public function addSottoSezioni($records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sottosezione',
            'options' => array(
                'label'         => '* Sottosezione',
                'empty_option'  => 'Seleziona',
                'value_options' => $records,
            ),
            'attributes' => array(
                'title'     => 'Seleziona sottosezione',
                'id'        => 'sottosezione',
                'required'  => 'required'
            )
        ));
    }

    public function addMainFormElements()
    {
        $this->add(array(
            'name' => 'titolo',
            'type' => 'Text',
            'options' => array('label' => '* Titolo'),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Titolo',
                'title'         => 'Inserisci il titolo',
                'id'            => 'titolo',
                'maxlength'     => 250
            )
        ));

        $this->add(array(
            'name' => 'sommario',
            'type' => 'Textarea',
            'options' => array('label' => 'Sotto titolo'),
            'attributes' => array(
                'id' => 'sommario',
                'placeholder'   => 'Sotto titolo...',
                'title'         => 'Inserisci sotto titolo',
                'maxlength'     => 200,
            )
        ));

        $this->add(array(
            'name' => 'testo',
            'type' => 'Textarea',
            'options' => array('label' => 'Testo'),
            'attributes' => array(
                'id'        => 'testo',
                'required'  => 'required',
                'class'     => 'wysiwyg'
            )
        ));

        $this->add(array(
            'type' => 'DateTime',
            'name' => 'dataInserimento',
            'options' => array(
                'label'  => '* Data inserimento',
                'format' => 'Y-m-d H:i:s',
            ),
            'attributes' => array(
                'style'         => 'width: 22%',
                'id'            => 'dataInserimento',
                'title'         => 'Seleziona data inserimento',
                'required'      => 'required',
                'placeholder'   => 'Data inserimento...',
            )
        ));

        $this->add(array(
            'type' => 'DateTime',
            'name' => 'dataScadenza',
            'options' => array(
                'label'     => '* Data scadenza',
                'format'    => 'Y-m-d H:i:s',
            ),
            'attributes' => array(
                'style'         => 'width: 22%',
                'id'            => 'dataScadenza',
                'title'         => 'Seleziona data scadenza',
                'required'      => 'required',
                'placeholder'   => 'Data scadenza...',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'attivo',
            'options' => array(
                'label' => '* Stato',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    1 => 'Attivo',
                    0 => 'Nascosto',
                ),
            ),
            'attributes' => array(
                'title'     => 'Seleziona stato',
                'id'        => 'attivo',
                'required'  => 'required'
            )
        ));
    }

    public function addHomeBox()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'home',
            'options' => array(
                'label'             => 'Inserisci in home page',
                'checked_value'     => 1,
                'unchecked_value'   => 0
            ),
            'attributes' => array(
                'id'    => 'home',
                'title' => 'Spunta la casella per inserire in home page'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'rss',
            'options' => array(
                'label' => 'Inserisci nel box notizie',
                'checked_value'     => 1,
                'unchecked_value'   => 0
            ),
            'attributes' => array(
                'id'    => 'rss',
                'title' => 'Spunta la casella per inserire nel box notizie'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array(
                "class" => 'hiddenField'
            )
        ));
    }

    public function addSocial()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'facebook',
            'options' => array(
                'label'             => 'Inserisci su facebook',
                'checked_value'     => 1,
                'unchecked_value'   => 0,
            ),
            'attributes' => array(
                'id'    => 'facebook',
                'title' => "Spunta la casella per postare l'articolo su facebook"
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
}
