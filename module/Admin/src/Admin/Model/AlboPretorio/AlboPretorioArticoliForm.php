<?php

namespace Admin\Model\AlboPretorio;

use Zend\Form\Element;
use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class AlboPretorioArticoliForm extends Form
{
    public function addTitolo()
    {
        $this->add(array(
            'type' => 'Text',
            'name' => 'titolo',
            'options' => array(
                'label' => '* Oggetto',
            ),
            'attributes' => array(
                'title'         => 'Inserisci oggetto articolo',
                'id'            => 'titolo',
                'required'      => 'required',
                'placeholder'   => 'Oggetto...',
            )
        ));
    }

    /**
     * Given sezioni from db, set the array for the select
     * 
     * @param array $sezioni
     */
    public function addSezioni(array $sezioni)
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'sezione',
                        'options' => array(
                            'label'         => '* Sezione',
                            'empty_option'  => 'Seleziona',
                            'value_options' => $sezioni,
                        ),
                        'attributes' => array(
                            'title'     => 'Seleziona sezione',
                            'id'        => 'sezione',
                            'required'  => 'required',
                        )
        ));
    }

    public function addNote()
    {
        $this->add(array(
                        'type' => 'Textarea',
                        'name' => 'note',
                        'options' => array(
                               'label' => '* Note',
                        ),
                        'attributes' => array(
                                'title'       => 'Inserisci note rettifica',
                                'id'          => 'note',
                                'placeholder' => 'Note rettifica',
                                'rows'        => 5,
                                'required'    => 'required',
                        )
        ));

        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'rettifica',
                        'attributes'    => array(
                            'class'     => 'hiddenField',
                            'value'     => 1,
                        )
        ));
    }

    public function addNumero()
    {
        $this->add(array(
            'type' => 'Text',
            'name' => 'numeroAtto',
            'options' => array(
                'label' => '* Numero',
            ),
            'attributes' => array(
                'title'       => 'Inserisci numero atto sezione',
                'id'          => 'numeroAtto',
                'required'    => 'required',
                'placeholder' => 'Numero atto',
                'type'        => 'number',
            )
        ));
    }

    public function addAnno()
    {
        $this->add(array(
            'type' => 'Text',
            'name' => 'anno',
            'options' => array(
                'label' => '* Anno',
            ),
            'attributes' => array(
                'title'         => 'Inserisci anno',
                'id'            => 'anno',
                'required'      => 'required',
                'placeholder'   => 'Anno atto',
                'type'          => 'number',
            )
        ));
    }
    
    public function addMainFields()
    {
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'enteTerzoLabel',
                        'attributes' => array(
                                        'id'    => 'enteTerzoLabel',
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
                                'id' => 'enteTerzo',
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
                                'id'    => 'fonteUrl',
                                'placeholder' => 'URL',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'start_date_label',
                        'attributes' => array(
                                        'id'    => 'expireDatesLabel',
                                        'value' => '<h4><strong>Scadenza</strong></h4><p>Se i campi vengono compilati entrambi prevale il numero di giorni in cui questo articolo rester&agrave; visibile (lasciare in bianco per renderlo sempre visibile) e la data di scadenza.</p>',
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
                        'name' => 'numeroGiorniScadenza',
                        'options' => array(
                               'label' => 'Numero di giorni',
                        ),
                        'attributes' => array(
                                'title'         => 'Numero di giorni alla scadenza',
                                'id'            => 'scadenza',
                                'placeholder'   => 'Giorni...',
                                'type'          => 'number'
                        )
        ));

        $this->add(array(
                        'type' => 'DateTime',
                        'name' => 'dataScadenza',
                        'options' => array(
                                'label' => '* Data di scadenza',
                                'format' => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'id'        => 'insertDate',
                                'title'     => 'Inserisci la data di pubblicazione',
                        )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'homepage',
            'options' => array(
                    'label' => 'Inserisci in home page',
                    'use_hidden_element' => true,
                    'checked_value'     => '1',
                    'unchecked_value'   => '',
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

    public function addFacebook()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'facebook',
            'options' => array(
                'label'                 => 'Inserisci su facebook',
                'use_hidden_element'    => false,
                'required'              => false,
                'checked_value'         => 1,
                'unchecked_value'       => '',
            ),
            'attributes' => array('id' => 'facebook')
        ));
    }
}
