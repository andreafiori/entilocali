<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Form;

class AlboPretorioForm extends Form
{
    public function __construct($name = null, $options = array())
    {    
        parent::__construct($name, $options);
                
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'oggetto',
                        'options' => array(
                               'label' => 'Oggetto',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci oggetto articolo',
                                'id'    => 'oggetto',
                                'required' => 'required',
                                'placeholder' => 'Oggetto articolo',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'sezione',
                        'options' => array(
                               'label' => 'Sezione',
                               'value_options' => array(
                                       '' => 'Seleziona',
                                       'attivo'   => 'Attivo',
                                       'nascosto' => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona sezione',
                                'id' => 'sezione'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'numero',
                        'options' => array(
                               'label' => 'Numero interno atto per sezione (formato N-AAAA es.: 1-2011)',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci titolo',
                                'id' => 'numero',
                                'placeholder' => 'Numero atto sezione',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'ente_terzo',
                        'options' => array(
                               'label' => 'Ente terzo',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci nome ente terzo',
                                'id' => 'ente_terzo',
                                'placeholder' => 'Ente terzo',
                        )
        ));        
        
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'fonte_url',
                        'options' => array(
                               'label' => 'Url (per link esterni inserire http://)',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci Url',
                                'id' => 'fonte_url',
                                'placeholder' => 'URL',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'start_date',
                        'attributes' => array(
                                        'id' => 'expireDates',
                                        'value' => '<h3>Scadenza</h3>',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
        /*
        $this->add(array(
                        'type' => 'Textarea',
                        'name' => 'note',
                        'options' => array(
                               'label' => 'Note',
                        ),
                        'attributes' => array(
                                'title' => "Inserisci note atto",
                                'id' => 'note',
                                'placeholder' => 'Note atto',
                        )
        ));
        */
    }
}
