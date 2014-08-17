<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  26 June 2014
 */
class ContrattiPubbliciFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $form = new ContrattiPubbliciForm();
        $form->setData( array("insertDate" => date("Y-m-d"), "expireDate" => date("2030-m-d")) );
        
        $this->setVariable('formTitle',         'Nuovo bando');
        $this->setVariable('formDescription',   'Inserisci nuovo bando. &Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo.');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        $this->getFormAction());
        $this->setVariable('formBreadCrumbCategory', 'Contratti pubblici');
        $this->setVariable('formLabelSpanWidth', 3);
        $this->setVariable('formControlSpanWidth', 9);
    }
    
        /**
         * @return string
         */
        private function getFormAction()
        {
            return '#';
        }
}