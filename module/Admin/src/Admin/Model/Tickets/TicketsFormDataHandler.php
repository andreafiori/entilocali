<?php

namespace Admin\Model\Tickets;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Tickets\TicketsForm;

/**
 * @author Andrea Fiori
 * @since  31 May 2013
 */
class TicketsFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $form = new TicketsForm();
        
        $this->setVariables(array(
            'form'  => $form,
            'formTitle' => "Nuova richiesta di assistenza",
            'formDescription' => "A seguito della richiesta, l'amministrazione provveder&agrave; a rispondere non appena possibile",
            'formAction' => "tickets/insert",
            'submitButtonValue' => 'Procedi',
            'formBreadCrumbCategory' => "Assistenza",
            'formBreadCrumbCategoryLink' => $this->getInput('baseUrl',1).'datatable/ticketing'
        ));
    }
}
