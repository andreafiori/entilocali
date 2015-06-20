<?php

namespace Application\Controller\AmministrazioneTrasparente;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiFormSearch;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormSearch;

class AmministrazioneTrasparenteController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $profondita = $this->params()->fromRoute('profondita');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $templateDir = $this->layout()->getVariable('templateDir');
        $basicLayout = $this->layout()->getVariable('amministrazione_trasparente_basiclayout');

        $formSearch = new ContenutiFormSearch();
        $formSearch->addAnno();
        $formSearch->addCheckExpired();
        $formSearch->addSubmitButton();
        $formSearch->setData( array('anno' => date("Y")) );

        $helper = new ContenutiControllerHelper();
        $sottosezioniRecords = $helper->recoverWrapperRecords(
            new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)),
            array(
                'attivo'                => 1,
                'profonditaDa'          => $profondita,
                'languageAbbreviation'  => 'it',
                'isAmmTrasparente'      => 1,
                'orderBy'               => 'sottosezioni.posizione ASC',
            )
        );

        $contenutiRecords = $helper->recoverWrapperRecords(
            new ContenutiGetterWrapper(new ContenutiGetter($em)),
            array(
                'sottosezione'      => $profondita,
                'attivo'            => 1,
                'noscaduti'         => 1,
                'isAmmTrasparente'  => 1,
                'orderBy'           => 'contenuti.posizione ASC'
            )
        );

        $this->layout()->setVariables(array(
            'form'                      => $formSearch,
            'sottoSezioni'              => $sottosezioniRecords,
            'contenuti'                 => !empty($contenutiRecords) ? $contenutiRecords : null,
            'templatePartial'           => 'amministrazione-trasparente/amministrazione-trasparente.phtml',
        ));

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}