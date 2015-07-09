<?php

namespace Admin\Controller\ContrattiPubblici;

use Application\Controller\ContrattiPubblici\ContrattiPubbliciSearchController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormSearch;
use Zend\Session\Container as SessionContainer;

/**
 * Contratti pubblici list
 */
class ContrattiPubbliciSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $userDetails = $this->layout()->getVariable('userDetails');

        $sessionContainer = new SessionContainer();
        $sessionSearch = $sessionContainer->offsetGet(ContrattiPubbliciSearchController::sessionIdentifier);

        try {

            $helper = new ContrattiPubbliciControllerHelper();
            $wrapper = $helper->recoverWrapperRecordsPaginator(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array(
                    'cig'       => isset($sessionSearch['cig'])     ? $sessionSearch['cig'] : null,
                    'anno'      => isset($sessionSearch['anno'])    ? $sessionSearch['anno'] : null,
                    'importo'   => isset($sessionSearch['importo']) ? $sessionSearch['importo'] : null,
                    'settoreId' => isset($sessionSearch['settore']) ? $sessionSearch['settore'] : null,
                    'orderBy'   => 'cc.id DESC'
                ),
                $page,
                $perPage
            );

            $yearsRecords = $helper->recoverWrapperRecords(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array('fields' => 'DISTINCT(cc.anno) AS anno', 'orderBy'   => 'cc.anno')
            );

            $helper->checkRecords($yearsRecords, 'Nessun contratto pubblico in archivio');

            if (!empty($yearsRecords)) {
                $yearsArray = array();
                foreach($yearsRecords as $year) {
                    if (isset($year['anno'])) {
                        $yearsArray[$year['anno']] = $year['anno'];
                    }
                }
            }

            $wrapperSettori = new UsersSettoriGetterWrapper(new UsersSettoriGetter($em));
            $wrapperSettori->setInput(array());
            $wrapperSettori->setupQueryBuilder();

            $settoriRecords = $wrapperSettori->getRecords();

            $settori = array();
            foreach($settoriRecords as $settore) {
                if (isset($settore['id']) and isset($settore['nome']) and isset($settore['surname'])) {
                    $settori[$settore['id']] = $settore['nome'].' '.$settore['name'].' '.$settore['surname'];
                }
            }

            $formSearch = new ContrattiPubbliciFormSearch();
            $formSearch->addMainFormElements();
            $formSearch->addYears($yearsArray);
            $formSearch->addSettori($settori);
            $formSearch->addSubmit();
            if ($sessionSearch) {
                $formSearch->setData(array(
                    'cig'       => isset($sessionSearch['cig']) ? $sessionSearch['cig'] : null,
                    'anno'      => isset($sessionSearch['anno']) ? $sessionSearch['anno'] : null,
                    'importo'   => isset($sessionSearch['importo']) ? $sessionSearch['importo'] : null,
                    'settore'   => isset($sessionSearch['settore']) ? $sessionSearch['settore'] : null,
                ));
            }

            $paginator = $wrapper->getPaginator();

            $helper = new ContrattiPubbliciControllerHelper();
            $wrapperDisattivati = $helper->recoverWrapperRecords(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array(
                    'fields'    => '(SELECT COUNT(contratti.id) FROM Application\Entity\ZfcmsComuniContratti contratti WHERE contratti.attivo = 0) AS disattivati',
                    'cig'       => isset($sessionSearch['cig'])     ? $sessionSearch['cig'] : null,
                    'anno'      => isset($sessionSearch['anno'])    ? $sessionSearch['anno'] : null,
                    'importo'   => isset($sessionSearch['importo']) ? $sessionSearch['importo'] : null,
                    'settoreId' => isset($sessionSearch['settore']) ? $sessionSearch['settore'] : null,
                    'orderBy'   => 'cc.id DESC'
                ),
                $page,
                $perPage
            );
            if (!empty($wrapperDisattivati)) {
                $disattivati = $wrapperDisattivati[0]['disattivati'];
            } else {
                $disattivati = 0;
            }

            $wrapper->setEntityManager($em);
            $wrapperRecords = $wrapper->addAttachmentsFromRecords(
                $wrapper->setupRecords(),
                array('moduleId' => ModulesContainer::contratti_pubblici_id)
            );

            $paginatorRecords = $this->formatArticoliRecords($wrapperRecords);

            $this->layout()->setVariables(array(
                    'tableTitle'        => 'Contratti pubblici',
                    'tableDescription'  => $paginator->getTotalItemCount()." contratti in archivio. ".$disattivati.' disattivati \ non visibili online.',
                    'formSearch'        => $formSearch,
                    'columns' => array(
                        "Oggetto del bando",
                        "Struttura proponente \ responsabili",
                        "Aggiudicatario",
                        /*
                        "Scelta del Contraente",
                        "Elenco degli Operatori invitati a presentare offerte",
                        "Vedi elenco" (posizione precednete)
                        */
                        "Scelta del contraente",
                        "Importo somme liquidate Euro",
                        /*
                        "Inserito da",
                        "Operatori invitati a presentare le offerte",
                        */
                        "Tempi",
                        "&nbsp;",
                        ($userDetails->acl->hasResource("contratti_pubblici_operatori_management")) ? "&nbsp;" : null,
                        ($userDetails->acl->hasResource("contratti_pubblici_update")) ? "&nbsp;" : null,
                        ($userDetails->acl->hasResource("contratti_pubblici_delete")) ? "&nbsp;" : null,
                        ($userDetails->acl->hasResource("contratti_pubblici_home")) ? "&nbsp;" : null,
                        ($userDetails->acl->hasResource("contratti_pubblici_attachments")) ? "&nbsp;" : null,
                    ),
                    'paginator'         => $paginator,
                    'sessionSearch'     => $sessionSearch,
                    'records'           => $paginatorRecords,
                    'templatePartial'   => 'datatable/datatable_contratti_pubblici.phtml',
                )
            );

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                    'messageType'       => 'warning',
                    'messageTitle'      => 'Problema verificato',
                    'messageText'       => $e->getMessage(),
                    'templatePartial'   => 'message.phtml'
                )
            );
        }

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param array $records
         * @return array
         */
        private function formatArticoliRecords($records)
        {
            $lang           = $this->params()->fromRoute('lang');
            $userDetails    = $this->layout()->getVariable('userDetails');

            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {

                    if ($row['attivo']==1) {
                        $enableDisableLink = $this->url()->fromRoute('admin/contratti-pubblici-operations', array(
                            'lang'      => $lang,
                            'id'        => $row['id'],
                            'action'    => 'disable',
                        ));
                    } else {
                        $enableDisableLink = $this->url()->fromRoute('admin/contratti-pubblici-operations', array(
                            'lang'      => $lang,
                            'id'        => $row['id'],
                            'action'    => 'enable',
                        ));
                    }

                    if ($userDetails->acl->hasResource("contratti_pubblici_delete")) {
                        $deleteButton = array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'title'     => 'Elimina contratto',
                            'data-id'   => $row['id']
                        );
                    }

                    $rowClass = '';
                    if ($row['attivo']==0) {
                        $rowClass = 'rowHidden';
                    }

                    /* Home page button check */
                    if ($userDetails->acl->hasResource("contratti_pubblici_home")) {
                        if ($row['attivo']) {

                            if ($row['homepage']==1) {
                                $homePageButton = array(
                                    'type'      => $row['homepage']==1 ? 'homepagePutButton' : 'homepageDelButton',
                                    'href'      => $this->url()->fromRoute('admin/homepage-management-delete', array(
                                        'lang'          => $lang,
                                        'referenceid'   => $row['id'],
                                        'modulecode'    => 'contratti-pubblici',
                                        'languageid'    => 1,
                                    )),
                                    'value'     => $row['homepage']==1 ? 1 : 0,
                                );
                            } else {

                                $homePageButton = array(
                                    'type'      => $row['homepage']==1 ? 'homepagePutButton' : 'homepageDelButton',
                                    'href'      => $this->url()->fromRoute('admin/homepage-management-insert', array(
                                        'lang'          => $lang,
                                        'referenceid'   => $row['id'],
                                        'modulecode'    => 'contratti-pubblici',
                                        'languageid'    => 1,
                                    )),
                                    'value'     => $row['homepage']==1 ? 1 : 0,
                                );
                            }

                        } else {
                            $homePageButton = '&nbsp;';
                        }
                    }

                    /* Update button check */
                    if ($userDetails->acl->hasResource("contratti_pubblici_update")) {
                        $updateButton = array(
                            'type' => 'updateButton',
                            'href' => $this->url()->fromRoute('admin/contratti-pubblici-form', array(
                                    'lang'  => $lang,
                                    'id'    => $row['id']
                                )
                            ),
                            'title'     => 'Modifica contratto'
                        );
                    }

                    /* Attachments button check */
                    if ($userDetails->acl->hasResource("contratti_pubblici_attachments")) {
                        $attachmentsButton = array(
                            'type' => 'attachButton',
                            'href' => $this->url()->fromRoute('admin/attachments-summary', array(
                                'lang' => $lang,
                                'module' => 'contratti-pubblici',
                                'referenceId' => $row['id']
                            )),
                            'title' => 'Gestione allegati',
                            'attachmentsFilesCount' => isset($row['attachments']) ? count($row['attachments']) : 0,
                        );
                    }

                    $arrayToReturn[] = array(
                        array(
                            'type'   => 'field',
                            'record' => "<strong>CIG:</strong> ".$row['cig']."<br><br><strong>Oggetto del bando</strong>: ".$row['titolo']."<br><br><strong>Anno:</strong> ".$row['anno']."<br><br> <strong>Data contratto:</strong> ".$row['dataInserimento'],
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => "<strong>CF:</strong> <br><br><strong>Str. prop.:</strong> ".$row['nomeSettore']."<br><br> <strong>Resp. Proc.:</strong> ".$row['responsabileUsersName'],
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => "<br><strong>Data aggiudicazione:</strong> <br><br> <strong>Importo di aggiudicazione (Euro):</strong> ".floatval($row['importoAggiudicazione']),
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => '<strong>Numero di offerte ammesse:</strong> '.$row['numeroOfferte']."<br><br><strong>Procedura di scelta del contraente:</strong> ".$row['nomeScelta'],
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => floatval($row['importoLiquidato']).' &euro;',
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => "<strong>Inizio lavori:</strong> ".date_format(date_create($row['dataInizioLavori']), 'd-m-Y')."<br><br> <strong>Fine lavori:</strong> ".$row['dataFineLavori']."<br><br> <strong>Scadenza:</strong> ".$row['scadenza'],
                            'class'  => $rowClass,
                        ),
                        /* Enable \ Disable button */
                        array(
                            'type'      => $row['attivo']==1 ? 'activeButton' : 'disableButton',
                            'href'      => $enableDisableLink,
                            'value'     => $row['attivo'],
                            'title'     => $row['attivo']==1 ? 'Nascondi contenuto sul sito' : 'Mostra contenuto sul sito',
                        ),
                        /* Aggiudicatari button */
                        array(
                            'type'      => 'multiuserButton',
                            'href'      =>  $this->url()->fromRoute('admin/contratti-pubblici-aggiudicatari', array(
                                'lang'  => $lang,
                                'id'    => $row['id'],
                            )),
                            'title'     => 'Elenco aggiudicatari \ partecipanti',
                        ),
                        !empty($updateButton) ? $updateButton : null,
                        !empty($deleteButton) ? $deleteButton : null,
                        !empty($homePageButton) ? $homePageButton : null,
                        !empty($attachmentsButton) ? $attachmentsButton : null,
                    );
                }
            }

            return $arrayToReturn;
        }
}
