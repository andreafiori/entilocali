<?php

namespace Admin\Controller\StatoCivile;

use Admin\Model\StatoCivile\StatoCivileFormSearch;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\StatoCivile\StatoCivileControllerHelper;
use Zend\Session\Container as SessionContainer;

class StatoCivileSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        $perPage = $this->params()->fromRoute('perpage');

        $sessionContainer = new SessionContainer();

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
        $helper->setStatoCivileGetterWrapper(new StatoCivileGetterWrapper(new StatoCivileGetter($em)));
        $helper->setupYears(array_merge(
            $statoCivileArticoliInput,
            array('fields' => 'DISTINCT(sca.anno) AS anno')
        ));
        $helper->setStatoCivileSezioniGetterWrapper(
            new StatoCivileSezioniGetterWrapper(new StatoCivileSezioniGetter($em))
        );
        $helper->setupSezioniRecords(array());

        $yearsList = $helper->getStatoCivileYears();

        $formSearch = new StatoCivileFormSearch();
        $formSearch->addFreeText();
        $formSearch->addProgressivo();
        $formSearch->addNumeroAtto();
        $formSearch->addMese();
        $formSearch->addSezioni( $helper->formatSezioniForFormSelect($helper->getSezioniRecords()) );
        $formSearch->addSubmitButton();
        $formSearch->addCheckExpired();
        $formSearch->addYears( !empty($yearsList) ? $yearsList : null );

        if ($this->getRequest()->isPost()) {
            $formSearch->setBindOnValidate(false);
            $formSearch->setData($post);

            $sessionContainer->offsetSet('statoCivileFormSearch', $post);
        } elseif ( !empty($formPostedValues) ) {
            $formSearch->setData($formPostedValues);
        }

        $wrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($em) );
        $wrapper->setInput($statoCivileArticoliInput);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage(is_numeric($page) ? $page : null);
        $wrapper->setupPaginatorItemsPerPage(is_numeric($perPage) ? $perPage : null);

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
                ),
                'formSearch'        => $formSearch,
                'records'           => $this->formatRecords($wrapper->setupRecords()),
                'paginator'         => $paginator,
                'total_item_count'  => $paginatorCount,
                'templatePartial'   => 'datatable/datatable_statocivile.phtml',
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param array|null $records
         *
         * @return boolean|array
         */
        private function formatRecords($records)
        {
            if (!$records) {
                return false;
            }

            $recordsToReturn = array();
            foreach($records as $record) {

                if ( $record['attivo']==0) {
                    $linkActiveDisable = $this->url()->fromRoute('admin/stato-civile-operations', array('lang' => 'it', 'action' => 'active', 'id' => $record['id']) );
                    $buttonType = 'disableButton';
                } else {
                    $linkActiveDisable = $this->url()->fromRoute('admin/stato-civile-operations', array('lang' => 'it', 'action' => 'disable', 'id' => $record['id']) );
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
                                'lang'  => 'it',
                                'id'    => $record['id'],
                            )
                        ),
                        'title' => 'Modifica'
                    ),
                    array(
                        'type'      => 'attachButton',
                        'href'      => $this->url()->fromRoute('admin/attachments-summary', array(
                                'lang'          => 'it',
                                'module'        => 'stato-civile',
                                'referenceId'   => $record['id'],
                            )
                        ),
                    ),
                    array(
                        'type' => 'enteterzoButton',
                        'href' => $this->url()->fromRoute('admin/invio-ente-terzo', array(
                                'lang'          => 'it',
                                'module'        => 'stato-civile',
                                'id'            => $record['id'],
                            )
                        ),
                        'title' => 'Invia ad ente terzo'
                    ),
                );
            }

            return $recordsToReturn;
        }
}