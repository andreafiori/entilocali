<?php

namespace Application\Controller;

use Zend\Session\Container as SessionContainer;

class CookieWarningController extends SetupAbstractController
{
    /**
     * @return \Zend\Http\Response
     */
    public function confirmAction()
    {
        $this->initializeFrontendWebsite();

        $sitename = $this->layout()->getVariable('sitename');

        $session = new SessionContainer();
        $session->offsetSet('cookie-warning', array($sitename => 1));

        $referer = $this->getRequest()->getHeader('Referer');
        if ($referer) {
            return $this->redirect()->toUrl($referer->getUri());
        }

        return $this->redirect()->toRoute('main', array('action' => 'index'));
    }

    /**
     * @return \Zend\Http\Response
     */
    public function denyAction()
    {
        $session = new SessionContainer();

        $session->offsetUnset('cookie-warning');

        $referer = $this->getRequest()->getHeader('Referer');
        if ($referer) {
            return $this->redirect()->toUrl($referer->getUri());
        }

        return $this->redirect()->toRoute('main', array('action' => 'index'));
    }
}