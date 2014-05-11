<?php

namespace Application\Model\AmministrazioneTrasparente;

use Application\Model\FrontendHelpers\FrontendRouterAbstract;
use Application\Model\FrontendHelpers\FrontendRouterInterface;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class AmministrazioneTrasparenteFrontend extends FrontendRouterAbstract implements FrontendRouterInterface
{
    public function setupFrontendRecord()
    {
        $this->setTemplate('amministrazione-trasparente/amministrazione-trasparente.phtml');
        
        return $this->getOutput();
    }
}
