<?php

namespace ModelModule\Model\AttiConcessione;

use Zend\Form\Form;

class AttiConcessioneFormSearch extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = null)
    {
        parent::__construct($name);

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3200
                )
            )
        ));
    }

    public function addAnno($years)
    {
        if (empty($years)) {
            $years = array();
            for($i = date("Y"); $i<date("Y")+5; $i++) {
                $years[] = $i;
            }
        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'anno',
            'attributes' => array(
                'title' => 'Seleziona anno di partenza dalla data di pubblicazione',
                'id'    => 'anno'
            ),
            'options' => array(
                'empty_option'  => 'Anno',
                'label'         => 'Anno',
                'value_options' => $years
            )
        ));
    }

    public function addMainElements()
    {
        $this->add(array(
            'type' => 'Text',
            'name' => 'codice',
            'attributes' => array(
                'placeholder'   => 'Cod...',
                'title'         => 'Inserisci codice',
                'id'            => 'codice',
                'maxlength'     => 150,
            ),
            'options' => array(
                'label' => 'Codice',
            )
        ));

        $this->add(array(
            'type' => 'Text',
            'name' => 'beneficiario',
            'attributes' => array(
                'placeholder'   => 'Beneficiario...',
                'title'         => 'Inserisci beneficiario',
                'id'            => 'beneficiario',
                'maxlength'     => 150,
            ),
            'options' => array(
                'label' => 'Beneficiario',
            )
        ));

        $this->add(array(
            'type' => 'Text',
            'name' => 'importo',
            'attributes' => array(
                'placeholder'   => 'Euro...',
                'title'         => 'Inserisci cifra importo',
                'id'            => 'importo',
                'maxlength'     => 20,
            ),
            'options' => array(
                'label' => 'Importo',
            )
        ));
    }

    /**
     * @param $settori
     * @return bool
     */
    public function addUfficio($settori)
    {
        if (!empty($settori)) {
            $this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'settore',
                'attributes' => array(
                    'title' => 'Seleziona ufficio e responsabile di servizio',
                    'id'    => 'settore'
                ),
                'options' => array(
                    'empty_option'  => 'Seleziona ufficio',
                    'label'         => 'Ufficio e responsabile di servizio',
                    'value_options' => $settori,
                )
            ));
        }
    }

    public function addSubmitSearchButton()
    {
        $this->add(array(
                'name' => 'search',
                'type'  => 'submit',
                'options' => array(
                    'label' => ' ',
                ),
                'attributes' => array(
                    'label' => '&nbsp;',
                    'title' => "Premi per avviare la ricerca sugli atti di concessione",
                    'value' => 'Cerca',
                    'id'    => 'submit',
                ))
        );
    }

    public function addResetButton()
    {
        $this->add(array(
                'name' => 'resetForm',
                'type'  => 'submit',
                'options' => array(
                    'label' => ' ',
                ),
                'attributes' => array(
                    'label' => '&nbsp;',
                    'title' => "",
                    'value' => 'Reset',
                    'id'    => 'resetForm',
                ))
        );
    }
}