<?php

namespace Application\Controller\AmministrazioneTrasparente;

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

        $amministrazione_trasparente_sottosezione_id = $this->layout()->getVariable('amministrazione_trasparente_sottosezione_id');

        $formSearch = new AmministrazioneTrasparenteFormSearch();
        $formSearch->setData( array('anno' => date("Y")) );

        $sottoSezioni = new SottoSezioniGetterWrapper(new SottoSezioniGetter($em));
        $sottoSezioni->setInput(array(
                'attivo'        => 1,
                'profonditaDa'  => $profondita
            )
        );
        $sottoSezioni->setupQueryBuilder();

        $wrapper = new ContenutiGetterWrapper(new ContenutiGetter($em));
        $wrapper->setInput( array(
                'sottosezione'  => $profondita,
                'attivo'        => 1,
                'noscaduti'     => 1,
            )
        );
        $wrapper->setupQueryBuilder();

        $this->layout()->setVariables(array(
            'form'             => $formSearch,
            'sottoSezioni'     => $sottoSezioni->getRecords(),
            'contenuti'        => $wrapper->getRecords(),
            'templatePartial'  => 'amministrazione-trasparente/amministrazione-trasparente.phtml',
            'amministrazione_trasparente_sottosezione_id' => $amministrazione_trasparente_sottosezione_id
        ));

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}