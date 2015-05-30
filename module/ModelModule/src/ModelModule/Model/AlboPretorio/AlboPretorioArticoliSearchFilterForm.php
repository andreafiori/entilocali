<?php

namespace ModelModule\Model\AlboPretorio;

/**
 * @author Andrea Fiori
 * @since  30 July 2014
 */
class AlboPretorioArticoliSearchFilterForm extends AlboPretorioArticoliFormAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'numero_atto',
            'attributes' => array(
                'placeholder' => '',
                'title'  => 'Inserisci numero atto',
                'id'     => 'numero_atto'
            ),
            'options' => array(
                'label' => 'Numero atto',
            )
        ));
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'titolo',
            'attributes' => array(
                'id'            => 'titolo',
                'title'         => 'Cerca testo negli articoli',
                'placeholder'   => 'Cerca negli articoli...'
            ),
            'options' => array(
                'label' => 'Testo',
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'hidden-search-field',
            'attributes' => array(
                    'value' => '1',
                    'id' => 'hidden-search-field',
                    'class' => 'hiddenField'
                )
            )
        );
    }
    
    public function addExpiredCheckbox()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'checkbox',
            'attributes' => array(
                'title'  => "Barra l'opzione per cercare solo atti non scaduti",
                'id'     => 'expired'
            ),
            'options' => array(
                'label'              => 'Cerca solo atti non scaduti',
                'use_hidden_element' => true,
                'checked_value'      => '1',
                'unchecked_value'    => '0'
            )
        ));
    }
}