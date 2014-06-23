<?php

namespace Admin\Model\Ticketing;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  31 May 2013
 */
class TicketingFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $form = new TicketingForm();
        
        $this->setVariable('formTitle',         "Nuova richiesta di assistenza");
        $this->setVariable('formDescription',   "A seguito della richiesta, l'amministrazione provveder&agrave; a rispondere non appena possibile");
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        "");
        
        $this->setVariable('formBreadCrumbCategory', "Assistenza");
        $this->setVariable('formBreadCrumbCategoryLink', $this->getInput('baseUrl',1).'datatable/ticketing');
    }
}