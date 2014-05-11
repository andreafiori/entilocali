<?php

namespace Application\Model\AlboPretorio;

use Application\Model\FrontendHelpers\FrontendRouterAbstract;
use Application\Model\FrontendHelpers\FrontendRouterInterface;
use Application\Form\AlboPretorioForm;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class AlboPretorioFrontend extends FrontendRouterAbstract implements FrontendRouterInterface
{
    public function setupFrontendRecord()
    {
        
        $this->setTemplate('albo-pretorio/index.phtml');
    }
}
