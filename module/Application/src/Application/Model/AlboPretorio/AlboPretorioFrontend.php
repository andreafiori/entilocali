<?php

namespace Application\Model\AlboPretorio;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Form\AlboPretorioForm;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class AlboPretorioFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setTemplate('albo-pretorio/index.phtml');
    }
}
