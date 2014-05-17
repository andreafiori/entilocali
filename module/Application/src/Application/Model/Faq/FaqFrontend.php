<?php

namespace Application\Model\Faq;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class FaqFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setTemplate('faq/faq.phtml');

        return $this->getOutput();
    }
}
