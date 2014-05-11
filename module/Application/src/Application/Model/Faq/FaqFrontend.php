<?php

namespace Application\Model\Faq;

use Application\Model\FrontendHelpers\FrontendRouterAbstract;
use Application\Model\FrontendHelpers\FrontendRouterInterface;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class FaqFrontend extends FrontendRouterAbstract implements FrontendRouterInterface
{
    public function setupFrontendRecord()
    {
        $this->setTemplate('faq/faq.phtml');

        return $this->getOutput();
    }
}
