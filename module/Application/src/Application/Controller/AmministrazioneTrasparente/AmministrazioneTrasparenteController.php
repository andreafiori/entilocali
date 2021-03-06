<?php

namespace Application\Controller\AmministrazioneTrasparente;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiFormSearch;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * Amministrazione trasparente frontend controller
 */
class AmministrazioneTrasparenteController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $profondita = $this->params()->fromRoute('profondita');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $templateDir = $this->layout()->getVariable('templateDir');
        $basicLayout = $this->layout()->getVariable('amministrazione_trasparente_basiclayout');

        try {
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

            $wrapperContenuti = $helper->recoverWrapper(
                new ContenutiGetterWrapper(new ContenutiGetter($em)),
                array(
                    'sottosezione'      => $profondita,
                    'attivo'            => 1,
                    'noscaduti'         => 1,
                    'isAmmTrasparente'  => 1,
                    'orderBy'           => 'contenuti.posizione ASC'
                )
            );
            $wrapperContenuti->setEntityManager($em);
            $contenutiRecords = $wrapperContenuti->addAttachmentsFromRecords(
                $wrapperContenuti->getRecords(),
                array(
                    'moduleId'              => ModulesContainer::amministrazione_trasparente_id,
                    'noscaduti'             => 1,
                    'status'                => 1,
                    'languageAbbreviation'  => 'it',
                    'orderBy'               => 'a.position'
                )
            );
            $helper->checkRecords($contenutiRecords, "I dati relativi all'articolo richiesto non sono stati trovati");

            $formSearch = new ContenutiFormSearch();
            $formSearch->addAnno();
            $formSearch->addCheckExpired();
            $formSearch->addSubmitButton();
            $formSearch->setData( array('anno' => date("Y")) );

            $this->layout()->setVariables(array(
                'form'                      => $formSearch,
                'sottoSezioni'              => $sottosezioniRecords,
                'contenuti'                 => !empty($contenutiRecords) ? $contenutiRecords : null,
                'templatePartial'           => 'amministrazione-trasparente/amministrazione-trasparente.phtml',
            ));

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageTitle'      => 'Nessun articolo trovato',
                'messageText'       => 'Impossibile visualizzare i dati per la richiesta effettuata',
                'moduleLabel'       => 'Amministrazione trasparente',
                'templatePartial'   => 'message.phtml',
            ));

            // TODO: log error
        }

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}