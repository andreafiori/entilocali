<?php

namespace Admin\Controller\Contenuti;

use Application\Controller\Contenuti\ContenutiSearchController;
use Application\Controller\Posts\PostsSearchController;
use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiFormSearch;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Languages\LanguagesFormSearch;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;
use Zend\Session\Container as SessionContainer;

/**
 * Contenuti Summary index
 */
class ContenutiSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em                     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $page                   = $this->params()->fromRoute('page');
        $perPage                = $this->params()->fromRoute('perPage');
        $configurations         = $this->layout()->getVariable('configurations');
        $userDetails            = $this->layout()->getVariable('userDetails');
        $userRole               = isset($userDetails->role) ? $userDetails->role : '';
        $userId                 = isset($userDetails->id) ? $userDetails->id : 1;
        $languageSelection      = $this->params()->fromRoute('languageSelection');
        $modulename             = $this->params()->fromRoute('modulename');
        $isAmmTrasparente       = ($modulename!='contenuti') ? 1 : 0;

        $sessionContainer = new SessionContainer();
        $sessionSearch = $sessionContainer->offsetGet(ContenutiSearchController::sessionIdentifier);

        $helper = new ContenutiControllerHelper();

        /* Detect form switch language */
        if ((!empty($configurations['isMultiLanguage'])) == 1 and $modulename == 'contenuti') {
            $helper->setLanguagesGetterWrapper(new LanguagesGetterWrapper(new LanguagesGetter($em)));
            $formLanguage = $helper->setupLanguageFormSearch(
                new LanguagesFormSearch(),
                array('status' => 1),
                $languageSelection
            );
        }

        try {
            $wrapper = $helper->recoverWrapperRecordsPaginator(
                new ContenutiGetterWrapper(new ContenutiGetter($em)),
                array_merge(array(
                        'showToAll'             => ($userRole=='WebMaster') ? null : 1,
                        'utente'                => ($userRole=='WebMaster') ? null : $userId,
                        'languageAbbreviation'  => $languageSelection,
                        'isAmmTrasparente'      => $isAmmTrasparente,
                        'inhome'                => isset($sessionSearch['inhome']) ? $sessionSearch['inhome'] : null,
                        'sottosezione'          => isset($sessionSearch['sottosezioni']) ? $sessionSearch['sottosezioni'] : null,
                        'freeSearch'            => isset($sessionSearch['testo']) ? $sessionSearch['testo'] : null,
                        'orderBy'               => 'contenuti.id DESC',
                    ),
                    !empty($sessionSearch) ? $sessionSearch : array()
                ),
                $page,
                $perPage
            );
            $sottoSezioniRecords = $helper->recoverWrapperRecords(
                new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)),
                array(
                    'isAmmTrasparente'      => $isAmmTrasparente,
                    'showToAll'             => ($userRole == 'WebMaster') ? null : 1,
                    'languageAbbreviation'  => $languageSelection,
                )
            );
            $helper->checkRecords($sottoSezioniRecords,'Nessuna sottosezione presente, verificare i parametri di ricerca e se sono presenti i dati');
            $sottoSezioniRecordsForDropDown = $helper->formatSottoSezioniGetterWrapperRecordsForDropdown($sottoSezioniRecords);

            $wrapper->setEntityManager($em);

            $paginatorRecords = $wrapper->addAttachmentsToPaginatorRecords(
                $wrapper->setupRecords(),
                array(
                    'moduleId'  => ($modulename=='contenuti') ? ModulesContainer::contenuti_id : ModulesContainer::amministrazione_trasparente_id,
                    'orderBy'   => 'a.position'
                )
            );

            $formSearch = new ContenutiFormSearch();
            $formSearch->addSottosezioni($sottoSezioniRecordsForDropDown);
            $formSearch->addInHome();
            $formSearch->addSubmitButton();
            $formSearch->setData(array_merge(
                array('languageSelection' => $languageSelection),
                !empty($sessionSearch) ? $sessionSearch : array()
            ));

            $paginator = $wrapper->getPaginator();

            $paginatorRecordsCount = $paginator->getTotalItemCount();

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'showMessage'       => 1,
                'messageType'       => 'danger',
                'messageTitle'      => 'Si &egrave; verificato un problema',
                'messageText'       => $e->getMessage(),
                'templatePartial'   => 'message.phtml',
            ));

        }

        $this->layout()->setVariables(array(
            'tableTitle'            => ($modulename=='contenuti') ? 'Contenuti' : 'Amministrazione trasparente',
            'tableDescription'      => (!empty($paginatorRecordsCount)) ? $paginatorRecordsCount.' articoli in archivio' : null,
            'paginator'             => (!empty($paginator)) ? $paginator : null,
            'records'               => !empty($paginatorRecords) ? $this->formatRecordsToShowOnTable($paginatorRecords) : null,
            'templatePartial'       => 'datatable/datatable_contenuti.phtml',
            'formSearch'            => (!empty($formSearch)) ? $formSearch : null,
            'formLanguage'          => isset($formLanguage) ? $formLanguage : null,
            'sessionSearch'         => isset($sessionSearch) ? $sessionSearch : null,
            'columns' => array(
                "Sezione",
                "Sotto sezione",
                "Titolo",
                'Date',
                'Inserito da',
                "&nbsp;",
                ($userDetails->acl->hasResource("contenuti_update")) ? "&nbsp;" : null,
                ($userDetails->acl->hasResource("contenuti_delete")) ? "&nbsp;" : null,
                ($userDetails->acl->hasResource("contenuti_homepage")) ? "&nbsp;" : null,
                ($userDetails->acl->hasResource("contenuti_attachments")) ? "&nbsp;" : null,
                ($isAmmTrasparente == 1 and $userDetails->acl->hasResource("amministrazione_trsparente_tabelle")) ? "&nbsp;" : null,
            ),
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Format records to show the on table summary
     *
     * @param array|null $records
     *
     * @return array
     */
    private function formatRecordsToShowOnTable($records, $languageId = 1)
    {
        $lang                   = $this->params()->fromRoute('lang');
        $languageSelection      = $this->params()->fromRoute('languageSelection');
        $modulename             = $this->params()->fromRoute('modulename');
        $isAmmTrasparente       = ($modulename!='contenuti') ? 1 : 0;
        $userDetails            = $this->layout()->getVariable('userDetails');

        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {

                if ($row['attivo']==1) {
                    $enableDisableLink = $this->url()->fromRoute('admin/contenuti-enabledisable', array(
                        'lang'              => $lang,
                        'languageSelection' => $languageSelection,
                        'modulename'        => $modulename,
                        'id'                => $row['id'],
                        'action'            => 'disable',
                    ));
                } else {
                    $enableDisableLink = $this->url()->fromRoute('admin/contenuti-enabledisable', array(
                        'lang'              => $lang,
                        'languageSelection' => $languageSelection,
                        'modulename'        => $modulename,
                        'id'                => $row['id'],
                        'action'            => 'enable',
                    ));
                }

                /* Home page put \ remove link */
                if ($row['home']==1) {
                    $homePutRemoveLink = $this->url()->fromRoute('admin/homepage-management-delete', array(
                        'lang'          => $lang,
                        'referenceid'   => $row['id'],
                        'modulecode'    => $modulename,
                        'languageid'    => $languageId, // TODO: detect language ID!!!
                    ));
                } else {
                    $homePutRemoveLink = $this->url()->fromRoute('admin/homepage-management-insert', array(
                        'lang'          => $lang,
                        'referenceid'   => $row['id'],
                        'modulecode'    => $modulename,
                        'languageid'    => $languageId, // TODO: detect language ID!!!
                    ));
                }

                if ($isAmmTrasparente == 1 and $userDetails->acl->hasResource("amministrazione_trsparente_tabelle")) {
                    $tableButton = array(
                        'type' => 'tableButton',
                        'href' => $this->url()->fromRoute('admin/amministrazione-trasparente-tabella', array(
                            'lang'              => $lang,
                            'languageSelection' => $languageSelection,
                            'id'                => $row['id']
                        )),
                        'attachmentsFilesCount' => isset($row['attachments']) ? count($row['attachments']) : 0,
                        'class' => $row['tabella']=='' ? 'icon-gray' : null,
                    );
                }

                if ($userDetails->acl->hasResource("contenuti_update")) {
                    $updateButton = array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/contenuti-form', array(
                                'lang'              => $lang,
                                'modulename'        => $modulename,
                                'languageSelection' => $languageSelection,
                                'id'                => $row['id'],
                                'previouspage'      => $this->params()->fromRoute('page'),
                            )
                        ),
                        'title' => 'Modifica contenuto'
                    );
                }

                if ($userDetails->acl->hasResource("contenuti_delete")) {
                    $deleteButton = array(
                        'type' => 'deleteButton',
                        'href' => $this->url()->fromRoute('admin/contenuti-operations', array(
                            'lang'                  => $this->params()->fromRoute('lang'),
                            'languageSelection'     => $languageSelection,
                            'action'                => 'delete',
                            'modulename'            => $modulename,
                            'id'                    => $row['id']
                        )),
                        'data-id' => $row['id'],
                        'title'   => 'Elimina articolo'
                    );
                }

                if ($userDetails->acl->hasResource("contenuti_homepage")) {
                    $homePageButton = array(
                        'type'  => $row['home']==1 ? 'homepagePutButton' : 'homepageDelButton',
                        'href'  => $homePutRemoveLink,
                        'value' => $row['home']==1 ? 'homepagePutButton' : 'homepageDelButton',
                    );
                }

                if ($userDetails->acl->hasResource("contenuti_attachments")) {
                    $attachmentButton = array(
                        'type' => 'attachButton',
                        'href' => $this->url()->fromRoute('admin/attachments-summary', array(
                            'lang'              => $lang,
                            'module'            => $modulename,
                            'referenceId'       => $row['id'],
                        )),
                        'attachmentsFilesCount' => isset($row['attachments']) ? count($row['attachments']) : 0,
                    );
                }

                $arrayToReturn[] = array(
                    $row['nomeSezione'],
                    $row['nomeSottosezione'],
                    !empty($row['titolo']) ? $row['titolo'] : '&nbsp;',
                    '<strong>Inserimento:</strong> '.date("d-m-Y H:i", strtotime($row['dataInserimento']))."<br><br><strong>Scadenza:</strong> ".date("d-m-Y H:i", strtotime($row['dataScadenza'])),
                    $row['name'].' '.$row['surname'],
                    /* Enable \ Disable button */
                    array(
                        'type'      => $row['attivo']==1 ? 'activeButton' : 'disableButton',
                        'href'      => $enableDisableLink,
                        'value'     => $row['attivo'],
                        'title'     => $row['attivo']==1 ? 'Nascondi contenuto sul sito' : 'Mostra contenuto sul sito',
                    ),
                    /* Edit button */
                    !empty($updateButton) ? $updateButton : null,
                    /* Delete button */
                    !empty($deleteButton) ? $deleteButton : null,
                    /* Homepage button */
                    !empty($homePageButton) ? $homePageButton : null,
                    /* Attachment button */
                    !empty($attachmentButton) ? $attachmentButton : null,
                    /* Tabella gestione "tabellare" amm. trasparente */
                    !empty($tableButton) ? $tableButton : null,
                );
            }
        }

        return $arrayToReturn;
    }
}