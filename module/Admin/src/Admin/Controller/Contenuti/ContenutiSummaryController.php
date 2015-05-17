<?php

namespace Admin\Controller\Contenuti;

use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Application\Controller\SetupAbstractController;

class ContenutiSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page           = $this->params()->fromRoute('page');
        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $configurations = $this->layout()->getVariable('configurations');
        $userDetails    = $this->layout()->getVariable('userDetails');

        $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($em) );
        $wrapper->setInput(array(
            'orderBy'               => 'contenuti.id DESC',
            'excludeSottosezioneId' => isset($configurations['amministrazione_trasparente_sottosezione_id']) ? $configurations['amministrazione_trasparente_sottosezione_id'] : null,
            'excludeSezioneId'      => isset($configurations['amministrazione_trasparente_sezione_id']) ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'showToAll'             => ($userDetails->role=='WebMaster') ? null : 1,
            'utente'                => ($userDetails->role=='WebMaster') ? null : $userDetails->id
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage( isset($page) ? $page : null );

        $paginator = $wrapper->getPaginator();

        $paginatorRecordsCount = $paginator->getTotalItemCount();

        $paginatorRecords = $this->formatRecordsToShowOnTable($wrapper->setupRecords());

        $this->layout()->setVariables(array(
            'tableTitle'            => 'Contenuti',
            'tableDescription'      => $paginatorRecordsCount.' contenuti in archivio',
            'paginator'             => $paginator,
            'total_item_count'      => $paginatorRecordsCount,
            'records'               => $paginatorRecords,
            'templatePartial'       => self::summaryTemplate,
            'columns' => array(
                "Titolo",
                "Sezione",
                "Sotto sezione",
                'Data inserimento',
                'Data scadenza',
                'Inserito da',
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
            ),
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array|null $records
     * @return array
     */
    private function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {

                $arrayToReturn[] = array(
                    $row['titolo'],
                    $row['nomeSezione'],
                    $row['nomeSottosezione'],
                    $row['dataInserimento'],
                    $row['dataScadenza'],
                    $row['name'].' '.$row['surname'],
                    array(
                        'type'      => $row['attivo']==1 ? 'disableButton' : 'activeButton',
                        'href'      => '',
                        'value'     => $row['attivo'],
                        'title'     => $row['attivo']==1 ? 'Nascondi contenuto' : 'Attiva contenuto',
                    ),
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->url()->fromRoute('admin/contenuti-form', array(
                                'lang'      => 'it',
                                'module'    => 'contenuti',
                                'id'        => $row['id']
                            )
                        ),
                        'title'     => 'Modifica contenuto'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => $this->getServiceLocator()
                            ->get('ViewHelperManager')
                            ->get('url')
                            ->__invoke('admin/delete-element', array(
                                'lang' => 'it',
                                'type' => 'contenuti'
                            )),
                        'data-id'   => $row['id'],
                        'title'     => 'Elimina contenuto'
                    ),
                    array(
                        'type'      => $row['home']==1 ? 'homepageDelButton' : 'homepagePutButton',
                        'href'      => '#',
                        'value'     => $row['home']==1 ? 'homepageDelButton' : 'homepagePutButton',
                    ),
                    array(
                        'type'      => 'attachButton',
                        'href'      => $this->url()->fromRoute('admin/attachments-form', array(
                                'lang'      => 'it',
                                'module'    => 'contenuti',
                                'id'        => $row['id']
                            )
                        ),
                    )
                );

            }
        }

        return $arrayToReturn;
    }
}