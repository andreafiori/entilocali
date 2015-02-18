<?php

namespace Admin\Model\ContrattiPubblici;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since 16 August 2014
 */
class SceltaContraenteForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'nomeScelta',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Nome' ),
                        'attributes' => array(
                                        'id' => 'nome_scelta',
                                        'title' => 'Inserisci nuova scelta contraente',
                                        'required' => 'required'
                        ),
        ));
    }
}
