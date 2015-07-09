<?php

namespace Application\Controller\AttiConcessione;

use ModelModule\Model\AttiConcessione\AttiConcessioneControllerHelper;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\AttiConcessione\AttiConcessioneFormSearch;
use ModelModule\Model\NullException;
use Zend\Session\Container as SessionContainer;

/**
 * Atti Concessione frontend controller
 */
class AttiConcessioneController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $templateDir = $this->layout()->getVariable('templateDir');

        $basicLayout = $this->layout()->getVariable('atti_concessione_basiclayout');

        $sessionContainer = new SessionContainer();
        $sessionSearch = $sessionContainer->offsetGet(AttiConcessioneSearchController::sessionIdentifier);

        try {
            $helper = new AttiConcessioneControllerHelper();

            $yearsRecords = $helper->recoverWrapperRecords(
                new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
                array(
                    'fields' => 'DISTINCT(atti.anno) AS year',
                    'orderBy' => 'atti.id DESC'
                ),
                $page,
                null
            );

            $wrapperArticoli = $helper->recoverWrapperRecordsPaginator(
                new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
                array(
                    'anno'                  => isset($sessionSearch['anno']) ? $sessionSearch['anno'] : null,
                    'codice'                => isset($sessionSearch['codice']) ? $sessionSearch['codice'] : null,
                    'beneficiarioSearch'    => isset($sessionSearch['beneficiario']) ? $sessionSearch['beneficiario'] : null,
                    'importo'               => isset($sessionSearch['importo']) ? $sessionSearch['importo'] : null,
                    'settore'               => isset($sessionSearch['settore']) ? $sessionSearch['settore'] : null,
                    'attivo'                => 1,
                    'orderBy'               => 'atti.id DESC',
                ),
                $page,
                null
            );

            $settoriRecords = $helper->recoverWrapperRecords(
                new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)),
                array('orderBy' => 'settore.nome')
            );

            $wrapperArticoli->setEntityManager($em);
            $articoliRecords = $wrapperArticoli->addAttachmentsToPaginatorRecords(
                $wrapperArticoli->setupRecords(),
                array(
                    'moduleId'  => ModulesContainer::atti_concessione,
                    'noScaduti' => 1,
                    'orderBy'   => 'a.position'
                )
            );

            $form = new AttiConcessioneFormSearch();
            $form->addAnno( $helper->formatYears($yearsRecords) );
            $form->addMainElements();
            $form->addUfficio( $helper->formatForDropwdown($settoriRecords, 'id', 'nome') );
            $form->addSubmitSearchButton();
            if (!empty($sessionSearch)) {
                $form->setData(array(
                    'anno'          => $sessionSearch['anno'],
                    'codice'        => $sessionSearch['codice'],
                    'beneficiario'  => $sessionSearch['beneficiario'],
                    'importo'       => $sessionSearch['importo'],
                    'settore'       => $sessionSearch['settore'],
                ));
            }

            $articoliPaginator = $wrapperArticoli->getPaginator();

            $this->layout()->setVariables(array(
                'records'                       => $articoliRecords,
                'form'                          => $form,
                'sessionSearch'                 => $sessionSearch,
                'paginator'                     => $articoliPaginator,
                'paginator_total_item_count'    => $articoliPaginator->getTotalItemCount(),
                'templatePartial'               => 'atti-concessione/atti-concessione.phtml',
            ));

        } catch(NullException $e) {

            $this->layout()->setVariables(array(
                'messageType'       => 'secondary',
                'messageText'       => "Si &egrave; verificato un problema o una mancanza di dati necessari per visualizzare la pagina richiesta",
                'templatePartial'   => 'atti-concessione/atti-concessione.phtml',
            ));

        }

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }

    /**
     * Atto concessione details
     */
    public function detailsAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        try {

            $helper = new AttiConcessioneControllerHelper();
            $wrapper = $helper->recoverWrapperById(
                new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
                array('id' => $id, 'limit' => 1),
                $id
            );
            $attoRecord = $wrapper->getRecords();
            $helper->checkRecords($attoRecord, 'Nessun atto di concessione trovato');
            $wrapper->setEntityManager($em);
            $records = $wrapper->addAttachmentsFromRecords(
                $attoRecord,
                array(
                    'moduleId'  => ModulesContainer::atti_concessione,
                    'noScaduti' => 1,
                    'orderBy'   => 'ao.position'
                )
            );

            $this->layout()->setVariables(array(
                'records'           => $records,
                'templatePartial'   => 'atti-concessione/atti-concessione-details.phtml'
            ));

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageType'       => 'secondary',
                'moduleLabel'       => "Atti di concessione",
                'messageTitle'      => "Nessun atto di concessione trovato",
                'messageText'       => "Impossibile visualizzare i dati richiesti",
                'templatePartial'   => 'message.phtml',
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }
}