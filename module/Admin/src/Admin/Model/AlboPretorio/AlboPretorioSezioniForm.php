<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class AlboPretorioSezioniForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'nome',
                        'options' => array(
                               'label' => 'Nome',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci nome sezione',
                                'id'    => 'nome',
                                'required' => 'required',
                                'placeholder' => 'Inserisci nome sezione...',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}