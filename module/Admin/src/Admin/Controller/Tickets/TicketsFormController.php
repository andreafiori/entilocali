<?php

namespace Admin\Controller\Tickets;

use ModelModule\Model\Tickets\TicketsForm;
use Application\Controller\SetupAbstractController;

class TicketsFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setVariables(array(
            'form'                          => new TicketsForm(),
            'formTitle'                     => "Nuova richiesta di assistenza",
            'formDescription'               => "A seguito della richiesta, l'amministrazione provveder&agrave; a rispondere non appena possibile",
            'formAction'                    => '#',
            'submitButtonValue'             => 'Procedi',
            'formBreadCrumbCategory'        => "Assistenza",
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/tickets-summary', array(
                'lang' => $this->params()->fromRoute('lang')
            )),
            'templatePartial'               => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}