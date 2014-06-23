<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\FormDataAbstract;

/**
 * TODO: check if module is active, check ACL, check sezioni
 * 
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
        $form->setData( array("insertDate" => date("Y-m-d"), "expireDate" => date("2030-m-d")) );
        
        $this->setVariable('formTitle',         'Nuovo atto');
        $this->setVariable('formDescription',   'Inserisci nuovo atto. &Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo.');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        $this->getFormAction());
        $this->setVariable('formBreadCrumbCategory', 'Stato civile');
    }
    
        /**
         * @return string
         */
        private function getFormAction()
        {
            return '';
        }
}