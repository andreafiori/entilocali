<?php

namespace Admin\Controller\Tickets;

use ModelModule\Model\Tickets\TicketsForm;
use Application\Controller\SetupAbstractController;

/**
 *
 * TODO:
        insert request into db
        send request to webmasters
        let the users answer to request and the webmaster to answer and eventually close the ticket
        change ticket status
 */
class TicketsOperationsController extends SetupAbstractController
{
    public function insertAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setTemplate($mainLayout);
    }
}