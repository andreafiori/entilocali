<?php

namespace Application\Controller\StatoCivile;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\StatoCivile\StatoCivileFormSearch;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetterWrapper;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use Zend\Session\Container as SessionContainer;

/**
 * Stato Civile Frontend Controller
 */
class StatoCivileController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');
        $perPage = $this->params()->fromRoute('perpage');

        $sessionContainer = new SessionContainer();
        $sessionSearch = $sessionContainer->offsetGet(StatoCivileSearchController::sessionIdentifier);

        try {

            $helper = new StatoCivileControllerHelper();
            $sezioniRecords = $helper->recoverWrapperRecords(
                new StatoCivileSezioniGetterWrapper(new StatoCivileSezioniGetter($em)),
                array()
            );
            $helper->checkRecords($sezioniRecords, 'Nessuna sezione stato civile in archivio');
            $sezioniRecordsForDropdown = $helper->formatForDropwdown(
                $sezioniRecords,
                'id',
                'nome'
            );
            $wrapper = $helper->recoverWrapperRecordsPaginator(
                new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
                array_merge(
                    array(
                        'textSearch' => isset($sessionSearch['testo']) ? $sessionSearch['testo'] : null,
                        'mese'       => isset($sessionSearch['mese']) ? $sessionSearch['mese'] : null,
                        'anno'       => isset($sessionSearch['anno']) ? $sessionSearch['anno'] : null,
                        'sezione'    => isset($sessionSearch['sezine']) ? $sessionSearch['sezine'] : null,
                    ),
                    array(
                        'attivo'    => 1,
                        'noScaduti' => 1,
                        'orderBy'   => 'sca.data DESC',
                    )
                ),
                $page,
                $perPage
            );

            $wrapper->setEntityManager($em);
            $wrapper->addAttachmentsToPaginatorRecords(
                $wrapper->setupRecords(),
                array(
                    'moduleId'  => ModulesContainer::stato_civile_id,
                    'noScaduti' => 1,
                    'orderBy'   => 'a.position'
                )
            );

            $paginator = $wrapper->getPaginator();

            $form = new StatoCivileFormSearch();
            $form->addTesto();
            $form->addSezioni($sezioniRecordsForDropdown);
            $form->addMese();
            $form->addAnni();
            $form->addCheckExpired();
            $form->addSubmitButton();
            $form->setData(array(
                'testo'             => isset($sessionSearch['testo']) ? $sessionSearch['testo'] : null,
                'mese'              => isset($sessionSearch['mese']) ? $sessionSearch['mese'] : null,
                'anno'              => isset($sessionSearch['anno']) ? $sessionSearch['anno'] : null,
                'sezione'           => isset($sessionSearch['sezione']) ? $sessionSearch['sezione'] : null,
            ));

        } catch(\Exception $e) {
            $paginator = null;
        }

        $this->layout()->setVariables(array(
            'sessionSearch'     => $sessionSearch,
            'paginator'         => !empty($paginator) ? $paginator : null,
            'emptyRecords'      => count($paginator),
            'records'           => !empty($paginator) ? $paginator : null,
            'form'              => !empty($form) ? $form : null,
            'templatePartial'   => 'stato-civile/stato-civile.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Stato civile details
     */
    public function detailsAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        $helper = new StatoCivileControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $wrapper->setEntityManager($em);
        $articoloRecord = $wrapper->addAttachmentsToPaginatorRecords(
            $wrapper->getRecords(),
            array('moduleId' => ModulesContainer::stato_civile_id)
        );

        $this->layout()->setVariables(array(
            'records'           => (!empty($articoloRecord)) ? $articoloRecord[0] : null,
            'notfound'          => empty($articoloRecord),
            'templatePartial'   => 'stato-civile/stato-civile-details.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}