<?php

namespace ModelModule\Model\CssStyleSwitch;

use ModelModule\Model\RouterManagers\RouterManagerAbstract;
use ModelModule\Model\RouterManagers\RouterManagerInterface;


class CssStyleSwitchFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);

        $sessionContainer = new SessionContainer();

        switch($param['route']['cssname']) {
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

        $redirect = $this->getInput('redirect', 1);
        $redirect->toRoute('home');
        
        return $this->getOutput();
    }
}
