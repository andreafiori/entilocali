<?php

namespace Application\Controller\Autocertificazioni;

use Application\Controller\SetupAbstractController;

/**
 *  Autocertificazioni main list controller
 */
class AutocertificazioniController extends SetupAbstractController
{
    /**
     * Autocertificazioni index list
     */
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $this->layout()->setVariables(array(
            'templatePartial' => 'autocertificazioni/autocertificazioniIndex.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Demografici list
     */
    public function demograficoAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $this->layout()->setVariables(array(
            'templatePartial' => 'autocertificazioni/autocertificazioniDemografico.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Polizia Municipale list
     */
    public function poliziamunicipaleAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $this->layout()->setVariables(array(
            'templatePartial' => 'autocertificazioni/autocertificazioniPoliziaMunicipale.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Servizi sociali list
     */
    public function servizisocialiAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $this->layout()->setVariables(array(
            'templatePartial' => 'autocertificazioni/autocertificazioniServiziSociali.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Ufficio tecnico list
     */
    public function ufficiotecnicoAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $this->layout()->setVariables(array(
            'templatePartial' => 'autocertificazioni/autocertificazioniUfficioTecnico.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}