<?php

namespace Application\Controller;

use Zend\Session\Container as SessionContainer;

/**
 * Change session value about CSS to use
 *
 * @author Andrea Fiori
 * @since  17 April 2015
 */
class CssStyleSwitchController extends SetupAbstractController
{
    public function indexAction()
    {
        $cssname = $this->params()->fromRoute('cssname');

        $sessionContainer = new SessionContainer();

        switch($cssname) {
            default:
                $sessionContainer->offsetSet('cssName', "default");
            break;

            case("high-visibility"):
                $sessionContainer->offsetSet('cssName', "high-visibility");
            break;

            case("rosso-su-nero"):
                $sessionContainer->offsetSet('cssName', "rosso-su-nero");
            break;

            case("text"):
                $sessionContainer->offsetSet('cssName', "text");
            break;
        }

        return $this->redirect()->toRoute('main');
    }
}
