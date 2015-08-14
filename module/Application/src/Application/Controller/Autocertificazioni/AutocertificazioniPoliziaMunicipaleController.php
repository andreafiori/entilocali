<?php

namespace Application\Controller\Autocertificazioni;

use Application\Controller\SetupAbstractController;

/**
 * Autocertificazioni view forms polizia municipale
 */
class AutocertificazioniPoliziaMunicipaleController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $this->layout()->setVariables(array(
            'templatePartial' => '',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}