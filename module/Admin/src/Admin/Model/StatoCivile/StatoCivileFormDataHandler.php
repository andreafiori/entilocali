<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $form = new StatoCivileForm();
        
        $this->setVariable('formTitle',         'Nuovo atto');
        $this->setVariable('formDescription',   'Inserisci nuovo atto');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        '');
        $this->setVariable('formBreadCrumbCategory', 'Stato civile');
    }
}