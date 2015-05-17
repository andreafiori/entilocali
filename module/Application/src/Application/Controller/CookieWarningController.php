<?php

namespace Application\Controller;

use Zend\Session\Container as SessionContainer;

class CookieWarningController extends SetupAbstractController
{
    public function confirmAction()
    {
        $this->initializeFrontendWebsite();

        $sitename = $this->layout()->getVariable('sitename');

        $session = new SessionContainer();
        $session->offsetSet('cookie-warning', array($sitename => 1));

        return $this->redirect()->toRoute('main', array('action' => 'index'));
    }

    public function denyAction()
    {
        $session = new SessionContainer();

        $session->offsetUnset('cookie-warning');

        return $this->redirect()->toRoute('main', array('action' => 'index'));
    }
}