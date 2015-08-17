<?php

namespace ModelModule\Model\Autocertificazioni\Demografico;

use ModelModule\Model\Autocertificazioni\AutocertificazioniFormAbstract;

class DomandaEspatrioMinoreForm extends AutocertificazioniFormAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'genitore',
            'options' => array(
                'label' => 'In qualit&agrave; di',
                'value_options' => array(
                    'padre' => 'Padre',
                    'madre' => "Madre",
                ),
            ),
            'attributes' => array(
                'value' => 'padre',
            ),
        ));


    }
}
