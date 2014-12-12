<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class AlboPretorioArticoliForm extends Form
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
                        'name' => 'titolo',
                        'options' => array(
                               'label' => '* Oggetto',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci oggetto articolo',
                                'id'    => 'oggetto',
                                'required' => 'required',
                                'placeholder' => 'Oggetto articolo',
                        )
        ));
    }
    
    /**
     * Given sezioni from db, set the array for the select
     * 
     * @param array $sezioni
     */
    public function addSezioni($sezioni)
    {
        if (is_array($sezioni)) {
    
            $sezioniRecords = array();
            foreach($sezioni as $sezione) {
                $sezioniRecords[$sezione['id']] = $sezione['nome'];
            }

            $this->add(array(
                            'type' => 'Zend\Form\Element\Select',
                            'name' => 'sezione',
                            'options' => array(
                                    'label' => '* Sezione',
                                    'empty_option' => 'Seleziona',
                                    'value_options' => $sezioniRecords,
                            ),
                            'attributes' => array(
                                    'title' => 'Seleziona sezione',
                                    'id' => 'sezione',
                                    'required' => 'required',
                            )
            ));
        }
    }
    
    public function addRettifica()
    {
        $this->add(array(
                        'type' => 'Textarea',
                        'name' => 'note',
                        'options' => array(
                               'label' => 'Note',
                        ),
                        'attributes' => array(
                                'title' => 'Note rettifica',
                                'id' => 'note',
                                'placeholder' => 'Note rettifica',
                        )
        ));
    }
    
    public function addLastFields()
    {
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'numeroAtto',
                        'options' => array(
                               'label' => '* Numero',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci numero atto sezione',
                                'id' => 'numero',
                                'required' => 'required',
                                'placeholder' => 'Numero atto',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'anno',
                        'options' => array(
                                'label' => '* Anno',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci anno',
                                'id' => 'numero',
                                'required' => 'required',
                                'placeholder' => 'Anno atto',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'ente_terzo_label',
                        'attributes' => array(
                                        'id' => 'ente_terzo_label',
                                        'value' => '<h4><strong>Ente terzo</strong></h4>',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'enteTerzo',
                        'options' => array(
                               'label' => 'Nome ente',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci nome ente terzo',
                                'id' => 'ente_terzo',
                                'placeholder' => 'Nome ente terzo',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Text',
                        'name' => 'fonteUrl',
                        'options' => array(
                               'label' => 'Url (per link esterni inserire http://)',
                        ),
                        'attributes' => array(
                                'title' => 'Inserisci Url',
                                'id' => 'fonteUrl',
                                'placeholder' => 'URL',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'start_date_label',
                        'attributes' => array(
                                        'id' => 'expireDates',
                                        'value' => '<h4><strong>Scadenza</strong></h4><p>Numero di giorni in cui questo articolo resterà visibile (lasciare in bianco per renderlo sempre visibile) e la data di scadenza.</p>',
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
                               'label' => 'Numero di giorni',
                        ),
                        'attributes' => array(
                                'title' => 'Numero di giorni alla scadenza',
                                'id' => 'scadenza',
                                'placeholder' => 'Numero di giorni alla scadenza',
                        )
        ));

        $this->add(array(
                        'type' => 'Date',
                        'name' => 'dataScadenza',
                        'options' => array(
                                'label' => 'Data di scadenza',
                                'format' => 'Y-m-d',
                        ),
                        'attributes' => array(
                                'class' => 'form-control DatePicker',
                                'id' => 'insertDate',
                                'title' => 'Inserisci la data di pubblicazione',
                        )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'homepage',
            'options' => array(
                    'label' => 'Inserisci in home page',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '',
            ),
            'attributes' => array('id' => 'homepage')
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'userId',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}
