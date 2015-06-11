<?php

namespace Admin\Controller\ContrattiPubblici\Operatori;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetterWrapper;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriControllerHelper;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetterWrapper;

class OperatoriAggiudicatariController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        $helper = new OperatoriControllerHelper();

        $partecipantiRecords = $helper->recoverWrapperRecords(
            new OperatoriAggiudicatariGetterWrapper(new OperatoriAggiudicatariGetter($em)),
            array('contrattoId' => $id)
        );
        $partecipanti = $helper->formatPartecipanti($partecipantiRecords, 1);
        $aggiudicatari = $helper->formatPartecipanti($partecipantiRecords);

        $contrattoRecord = $helper->recoverWrapperRecords(
            new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
            array('id' => $id, 'limit' => 1)
        );

        $operatori = $helper->recoverWrapperRecords(
            new OperatoriGetterWrapper(new OperatoriGetter($em)),
            array('excludeId' => $helper->gatherPartecipantiId($partecipantiRecords))
        );

        $this->layout()->setVariables(array(
            'contratto'                 => $contrattoRecord,
            'operatori'                 => $operatori,
            'operatoriPartecipanti'     => $partecipanti,
            'operatoriAggiudicatari'    => $aggiudicatari,
            'templatePartial'           => 'contratti-pubblici/contratti-pubblici-aggiudicatari.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}