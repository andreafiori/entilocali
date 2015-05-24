<?php

namespace Admin\Controller\Tickets;

use Admin\Model\Tickets\TicketsForm;
use Application\Controller\SetupAbstractController;

/**
 *
 * TODO:
 *  insert request into db, send request to webmaster
 *  change state of the ticket
 *  let the users answer to request and the webmaster to answer and eventually close the ticket
 *
 */
class TicketsOperationsController extends SetupAbstractController
{
    public function insertAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setTemplate($mainLayout);
    }
}