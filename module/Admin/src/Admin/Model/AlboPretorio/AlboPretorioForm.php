<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class AlboPretorioForm extends Form
{
    /**
     * @param type $name
     * @param type $options
     */
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
    }
    
    public function addSezioni(array $sezioni)
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'sezione',
                        'options' => array(
                               'label' => 'Sezione',
                                'empty_option' => 'Seleziona',
                               'value_options' => $sezioni,
                        ),
                        'attributes' => array(
                                'title' => 'Seleziona sezione',
                                'id' => 'sezione'
                        )
        ));
    }
    
    public function addLastFields()
    {
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
                                        'value' => '<h4><strong>Scadenza</strong></h4><p>Indicare un numero di giorni in cui l\'articolo </p>',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
    
    public function addScadenze()
    {
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'scadenza',
                        'options' => array(
                               'label' => 'Numero di giorni in cui questo articolo rester&agrave; visibile (lasciare in bianco per renderlo sempre visibile)',
                        ),
                        'attributes' => array(
                                'title' => '',
                                'id' => 'scadenza',
                                'placeholder' => 'Numero di giorni alla scadenza',
                        )
        ));

        $this->add(array(
                        'type' => 'Date',
                        'name' => 'insertDate',
                        'options' => array(
                                'label' => 'Data di scadenza:',
                                'format' => 'Y-m-d',
                        ),
                        'attributes' => array(
                                'class' => 'form-control DatePicker',
                                'style' => 'width: 22%',
                                'id' => 'insertDate',
                                'title' => 'Inserisci la data di pubblicazione',
                        )
        ));
        
        // Numero di file allegati a questo articolo
        // inviato a regione checkbox
        // inserisci in home checkbox
        // Associa articolo a utente
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
    
    public function addNotes()
    {
        $this->add(array(
                        'type' => 'Textarea',
                        'name' => 'note',
                        'options' => array(
                               'label' => 'Note',
                        ),
                        'attributes' => array(
                                'title' => "Inserisci note atto",
                                'id' => 's',
                                'placeholder' => 'Note atto',
                        )
        ));
    }
}
