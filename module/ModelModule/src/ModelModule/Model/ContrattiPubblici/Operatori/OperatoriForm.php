<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use Zend\Form\Form;

class OperatoriForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {        
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class" => 'hiddenField')
        ));

        $this->add(array(
                        'name' => 'nome',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome' ),
                        'attributes' => array(
                                        'id'            => 'nome',
                                        'placeholder'   => 'Nome...',
                                        'title'         => 'Inserisci nome',
                                        'required'      => 'required'
                        ),
        ));
        
        $this->add(array(
                        'name' => 'cf',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Codice fiscale' ),
                        'attributes' => array(
                                        'id' => 'cf',
                                        'placeholder' => 'Codice fiscale...',
                                        'title'       => 'Inserisci codice fiscale',
                                        'required'    => 'required'
                        ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ragioneSociale',
            'options' => array(
                'label'         => '* Ragione sociale',
                'empty_option'  => 'Seleziona',
                'value_options' => array(
                    array('label' => 'Societa di persone', 'options' =>
                        array(
                            'S.S'       => 'S.S Societa semplice',
                            'S.n.c.'    => 'S.n.c. Societa nome collettivo',
                            'S.a.s.'    => 'S.a.s. Societa in accomandita semplice'
                        )
                    ),
                    array('label' => 'Societa di capitali', 'options' =>
                        array(
                            'S.r.l.'    => 'S.r.l. responsabilita limitata',
                            'S.r.l.s.'  => 'S.r.l.s.',
                            'S.r.l.u.'  => 'S.r.l.u.',
                            'S.p.a.'    => 'S.p.a. per azioni',
                            'S.a.p.a.'  => 'S.a.p.a.',
                        )
                    ),
                ),
            ),
            'attributes' => array(
                'title'     => 'Seleziona ragione sociale',
                'id'        => 'sezione',
                'required'  => 'required',
            )
        ));
    }
}