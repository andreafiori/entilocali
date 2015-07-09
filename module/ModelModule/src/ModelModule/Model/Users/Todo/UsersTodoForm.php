<?php

namespace ModelModule\Model\Users\Todo;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  26 March 2015
 */
class UsersTodoForm  extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'task_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'task_name',
                'placeholder'   => 'Titolo...',
                'required'      => 'required',
                'title'         => 'Aggiungi titolo'
            ),
            'options' => array(
                'label' => '* Titolo',
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id'            => 'descrizione',
                'required'      => 'required',
                'placeholder'   => 'Descrizione...',
                'rows'          => 5,
                'title' => 'Aggiungi descrizione'
            ),
            'options' => array(
                'label' => '* Descrizione',
            ),
        ));

        $this->add(array(
            'name' => 'expireDate',
            'type' => 'Zend\Form\Element\Date',
            'attributes' => array(
                'id'          => 'expireDate',
                'placeholder' => 'Da fare entro il...',
                'min'         => '1970-01-01',
                'step'        => '1',
                'required'    => 'required',
                'title'       => 'Da fare entro il...'
            ),
            'options' => array(
                'label' => '* Da fare entro il',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}