<?php

namespace Admin\Model\ContrattiPubblici;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class ResponsabiliProcedimentoForm extends Form
{
    /**
     * @param string $name
     * @param string $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'nomeResp',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'placeholder' => 'Nome...',
                                        'title' => 'Inserisci il nome responsabile',
                                        'id' => 'nomeResp',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}
