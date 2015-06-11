<?php

namespace Admin\Controller\StatoCivile;

use ModelModule\Model\StatoCivile\StatoCivileFormSearch;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetterWrapper;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use Zend\Session\Container as SessionContainer;
use Application\Controller\SetupAbstractController;

class StatoCivileSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');
        $perPage = $this->params()->fromRoute('perpage');

        $sessionContainer = new SessionContainer();
        try {

            $formPostedValues = $sessionContainer->offsetGet('statoCivileFormSearch');
            $request = $this->getRequest();
            if ($request->isPost()) {
                $post = array_merge_recursive(
                    $request->getPost()->toArray(),
                    $request->getFiles()->toArray()
                );
            } else {
                $post = $formPostedValues;
            }

            $statoCivileArticoliInput = array(
                'numero'        => isset($post['numero']) ? $post['numero'] : null,
                'anno'          => isset($post['anno']) ? $post['anno'] : null,
                'sezioneId'     => isset($post['sezione']) ? $post['sezione'] : null,
                'noScaduti'     => isset($post['expired']) ? $post['expired'] : null,
                'textSearch'    => isset($post['testo']) ? $post['testo'] : null,
                'orderBy'       => 'sca.id DESC',
            );

            $helper = new StatoCivileControllerHelper();
            $yearsList = $helper->setupYears(
                new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
                array_merge(
                    $statoCivileArticoliInput,
                    array('fields' => 'DISTINCT(sca.anno) AS anno')
                )
            );
            $sezioniRecords = $helper->recoverWrapperRecords(
                new StatoCivileSezioniGetterWrapper(new StatoCivileSezioniGetter($em)),
                array()
            );
            $helper->checkRecords($sezioniRecords, "Nessuna sezione in archivio");
            $sezioniRecordsForDropDown = $helper->formatForDropwdown(
                $sezioniRecords,
                'id',
                'nome'
            );

            $formSearch = new StatoCivileFormSearch();
            $formSearch->addTesto();
            $formSearch->addProgressivo();
            $formSearch->addNumeroAtto();
            $formSearch->addMese();
            $formSearch->addSezioni($sezioniRecordsForDropDown);
            $formSearch->addSubmitButton();
            $formSearch->addCheckExpired();
            $formSearch->addAnni($yearsList);

            if ($this->getRequest()->isPost()) {

                $formSearch->setBindOnValidate(false);
                $formSearch->setData($post);

                $sessionContainer->offsetSet('statoCivileFormSearch', $post);

            } elseif ( !empty($formPostedValues) ) {
                $formSearch->setData($formPostedValues);
            }

            $wrapper = $helper->recoverWrapperRecordsPaginator(
                new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
                $statoCivileArticoliInput,
                $page,
                $perPage
            );

            $wrapper->setEntityManager($em);
            $attiRecords = $wrapper->addAttachmentsFromRecords($wrapper->setupRecords());

            $paginator = $wrapper->getPaginator();

            $paginatorCount = $paginator->getTotalItemCount();

            $this->layout()->setVariables( array(
                    'tableTitle'        => 'Stato civile',
                    'tableDescription'  => $paginatorCount.' atti stato civile in archivio',
                    'columns'           => array(
                        "Titolo",
                        "Numero / Anno",
                        "Sezione",
                        "Inserito il",
                        "Scadenza",
                        "Inserito da",
                        "&nbsp;",
                        "&nbsp;",
                        "&nbsp;",
                        "&nbsp;",
                        "&nbsp;",
                        "&nbsp;",
                    ),
                    'formSearch'        => $formSearch,
                    'records'           => $this->formatRecords($attiRecords),
                    'paginator'         => $paginator,
                    'templatePartial'   => 'datatable/datatable_statocivile.phtml',
                )
            );

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageType'       => 'warning',
                'messageTitle'      => 'Errore verificato',
                'messageText'       => $e->getMessage(),
                'templatePartial'   => 'message.phtml'
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param array|null $records
         *
         * @return boolean|array
         */
        private function formatRecords($records)
        {
            $lang = $this->params()->fromRoute('lang');

            if (!$records) {
                return false;
            }

            $recordsToReturn = array();
            foreach($records as $record) {

                if ( $record['attivo']==0) {
                    $linkActiveDisable = $this->url()->fromRoute('admin/stato-civile-operations', array(
                        'lang'      => $lang,
                        'action'    => 'active',
                        'id'        => $record['id']
                    ));
                    $buttonType = 'disableButton';
                } else {
                    $linkActiveDisable = $this->url()->fromRoute('admin/stato-civile-operations', array(
                        'lang'      => $lang,
                        'action'    => 'disable',
                        'id'        => $record['id']
                    ));
                    $buttonType = 'activeButton';
                }

                $recordsToReturn[] = array(

                    $record['titolo'],
                    $record['progressivo'].' / '.$record['anno'],
                    $record['nome'],
                    $record['data'],
                    $record['scadenza'],
                    $record['user_name_surname'],
                    array(
                        'type'      => $buttonType,
                        'href'      => $linkActiveDisable,
                        'value'     => $record['attivo'],
                        'title'     => 'Attiva \ Disattiva'
                    ),
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->url()->fromRoute('admin/stato-civile-form', array(
                                'lang'  => $lang,
                                'id'    => $record['id'],
                            )
                        ),
                        'title' => 'Modifica atto'
                    ),
                    array(
                        'type' => 'deleteButton',
                        'href' => $this->url()->fromRoute('admin/stato-civile-delete', array(
                                'lang'          => $this->params()->fromRoute('lang'),
                                'action'        => 'delete',
                                'id'            => $record['id']
                            )
                        ),
                        'data-id' => $record['id'],
                        'title'   => 'Elimina atto'
                    ),
                    array(
                        'type'      => 'attachButton',
                        'href'      => $this->url()->fromRoute('admin/attachments-summary', array(
                            'lang'          => $lang,
                            'referenceId'   => $record['id'],
                            'module'        => 'stato-civile',
                        )),
                        'attachmentsFilesCount' => isset($row['attachments']) ? count($row['attachments']) : 0,
                    ),
                    array(
                        'type'      => 'homepageDelButton',
                        'href'      => '#',
                        'value'     => 'homepageDelButton',
                    ),
                    array(
                        'type' => 'enteterzoButton',
                        'href' => $this->url()->fromRoute('admin/invio-ente-terzo', array(
                            'lang'      => $lang,
                            'id'        => $record['id'],
                            'module'    => 'stato-civile',
                        )),
                        'title' => 'Invia ad ente terzo'
                    ),
                );
            }

            return $recordsToReturn;
        }
}