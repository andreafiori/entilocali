<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 *
 */
class BackendController extends AbstractActionController
{
    public function indexAction()
    {
        $this->layout()->setTemplate('backend/backend/index');
    }
}
