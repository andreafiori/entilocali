<?php

namespace Application\Controller\AmministrazioneTrasparente;

use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormSearch;

class AmministrazioneTrasparenteController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $profondita = $this->params()->fromRoute('profondita');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $templateDir = $this->layout()->getVariable('templateDir');

        $basicLayout = $this->layout()->getVariable('amministrazione_trasparente_basiclayout');

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
        ));

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}