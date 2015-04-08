<?php

namespace Admin\Controller\AlboPretorio;

use Application\Controller\SetupAbstractController;

/**
 * @author Andrea Fiori
 * @since  06 April 2015
 */
class AlboPretorioSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $templateDir = $this->layout()->getVariable('templateDir');

        $this->layout()->setVariable('templatePartial', $templateDir.'empty.phtml');

        return $this->layout($mainLayout);
    }
}