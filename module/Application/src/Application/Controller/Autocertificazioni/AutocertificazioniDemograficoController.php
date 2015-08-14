<?php

namespace Application\Controller\Autocertificazioni;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Autocertificazioni\Demografico\DichiarazioneAttoNotorieta1Form;
use ModelModule\Model\Autocertificazioni\Demografico\DichiarazioneAttoNotorieta2Form;
use ModelModule\Model\Autocertificazioni\Demografico\DichiarazioneResidenzaForm;

/**
 * Autocertificazioni view forms demografico
 */
class AutocertificazioniDemograficoController extends SetupAbstractController
{
    /**
     * Dichiarazione residenza 1 form
     */
    public function dichiarazioneresidenza1Action()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new DichiarazioneResidenzaForm();

        $this->layout()->setVariables(array(
            'form'            => $form,
            'templatePartial' => 'autocertificazioni/forms/demografico/dichiarazione-residenza1.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Dichiarazione residenza 2 form
     */
    public function dichiarazioneresidenza2Action()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new DichiarazioneResidenzaForm();

        $this->layout()->setVariables(array(
            'form'            => $form,
            'templatePartial' => 'autocertificazioni/forms/demografico/dichiarazione-residenza2.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
    * Dichiarazione atto notorieta 1
    */
    public function dichiarazioneattonotorieta1Action()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new DichiarazioneAttoNotorieta1Form();

        $this->layout()->setVariables(array(
            'form'            => $form,
            'templatePartial' => 'autocertificazioni/forms/demografico/dichiarazione-sostitutiva-notorieta1.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Dichiarazione atto notorieta 2
     */
    public function dichiarazioneattonotorieta2Action()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new DichiarazioneAttoNotorieta2Form();

        $this->layout()->setVariables(array(
            'form'            => $form,
            'templatePartial' => 'autocertificazioni/forms/demografico/dichiarazione-sostitutiva-notorieta2.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Dichiarazione espatrio minore
     */
    public function dichiarazioneespatriominoreAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new DichiarazioneAttoNotorieta2Form();

        $this->layout()->setVariables(array(
            'form'            => $form,
            'templatePartial' => 'autocertificazioni/forms/demografico/dichiarazione-espatrio-minore.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * AUTOCERTIFICAZIONE STATO DI FAMIGLIA E RESIDENZA ALL’ATTO DEL DECESSO
     */
    public function statofamigliaAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new DichiarazioneAttoNotorieta2Form();

        $this->layout()->setVariables(array(
            'form'            => $form,
            'templatePartial' => '',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}