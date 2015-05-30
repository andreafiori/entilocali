<?php

namespace ModelModule\Model\Languages;

use Zend\Form\Form;

class LanguagesFormSearch extends Form
{
    /**
     * @param array $langRecords
     */
    public function addLanguages($langRecords)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'lingua',
            'options' => array(
                'label' => '* Seleziona lingua',
                'empty_option' => 'Seleziona',
                'value_options' => $langRecords,
            ),
            'attributes' => array(
                'title'     => 'Seleziona lingua corrente',
                'id'        => 'lingua',
                'required'  => 'required'
            )
        ));
    }

    public function addSubmitButton()
    {
        $this->add(array(
                'name' => 'sbmtlang',
                'type'  => 'submit',
                'attributes' => array(
                    'label' => '&nbsp;',
                    'title' => "Premi per cambiare la lingua corrente",
                    'value' => 'Cambia lingua',
                    'id'    => 'sbmtlang',
                ))
        );
    }
}
