<?php

namespace Application\Model\Contatti;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * Response after sending message
 *
 * @author Andrea Fiori
 * @since  16 May 2014
 */
class ContattiResponseFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setTemplate('stato-civile/index.phtml');
    }
}
