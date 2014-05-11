<?php

namespace Application\Model\StatoCivile;

use Application\Model\FrontendHelpers\FrontendRouterAbstract;
use Application\Model\FrontendHelpers\FrontendRouterInterface;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class StatoCivileFrontend extends FrontendRouterAbstract implements FrontendRouterInterface
{
    public function setupFrontendRecord()
    {
        $this->setTemplate('stato-civile/index.phtml');
    }
}
