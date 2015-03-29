<?php

namespace Admin\Model\Users\RespProc;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  25 March 2015
 */
class UsersRespProcForm extends Form
{
    /**
     * @param array $records
     */
    public function addUsers($records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'user',
            'options' => array(
                'label'          => '* Utente',
                'empty_option'   => 'Seleziona',
                'value_options'  => $records,
            ),
            'attributes' => array(
                'id'        => 'ufficioResponsabile',
                'title'     => 'Seleziona utente',
                'required'  => 'required',
            )
        ));
    }
}