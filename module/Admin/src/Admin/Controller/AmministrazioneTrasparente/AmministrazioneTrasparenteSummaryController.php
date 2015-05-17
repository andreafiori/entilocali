<?php

namespace Admin\Controller\AmministrazioneTrasparente;

use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Application\Controller\SetupAbstractController;

class AmministrazioneTrasparenteSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page       = $this->params()->fromRoute('page');

        $perPage    = $this->params()->fromRoute('perpage');

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $sezioneId = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');

        $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($em) );
        $wrapper->setInput( array(
                'orderBy'    => 'contenuti.id DESC',
                'sezioneId'  => is_numeric($sezioneId) ? $sezioneId : null,
            )
        );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage($perPage);
        $wrapper->setEntityManager($em);

        $paginator = $wrapper->getPaginator();

        $paginatorRecords = $this->formatRecords($wrapper->setupRecords());

        $this->layout()->setVariables(array(
                'tableTitle'            => 'Amministrazione trasparente',
                'tableDescription'      => 'Gestione amministrazione trasparente',
                'paginator'             => $paginator,
                'records'               => $paginatorRecords,
                'templatePartial'       => self::summaryTemplate,
                'columns' => array(
                    "Sezione",
                    "Sottosezione",
                    "Titolo",
                    "Anno",
                    "Data inserimento",
                    "Data scadenza",
                    "Inserito da",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                ),
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array|null $records
     * @return boolean|array
     */
    private function formatRecords($records)
    {
        if (empty($records)) {
            return false;
        }

        $recordsToReturn = array();
        foreach($records as $record) {
            $record = array_map('utf8_encode', $record);
            $activeDisableButtonValue = ($record['attivo']!=0) ? 'toDisable' : 'toActive';
            $recordsToReturn[] = array(
                $record['nomeSezione'],
                utf8_encode($record['nomeSottosezione']),
                utf8_encode($record['titolo']),
                $record['anno'],
                $record['dataInserimento'],
                $record['dataScadenza'],
                $record['name'].' '.$record['surname'],
                array(
                    'type'      => $record['home']!=0 ? 'homepagePutButton' : 'homepageDelButton',
                    'href'      => '?homepage='.$activeDisableButtonValue.'&amp;id='.$record['id'],
                    'value'     => $record['attivo'],
                    'title'     => 'Homepage'
                ),
                array(
                    'type'      => $record['attivo']!=0 ? 'activeButton' : 'disableButton',
                    'href'      => '?active='.$activeDisableButtonValue.'&amp;id='.$record['id'],
                    'value'     => $record['attivo'],
                    'title'     => 'Attiva \ Disattiva'
                ),
                array(
                    'type'      => 'updateButton',
                    'href'      => $this->url()->fromRoute('admin/amministrazione-trasparente-form', array(
                            'lang'  => 'it',
                            'id'    => $record['id'],
                        )
                    ),
                    'title'     => 'Modifica'
                ),
                array(
                    'type'      => 'deleteButton',
                    'href'      => '#',
                    'title'     => 'Elimina',
                    'data-id'   => $record['id']
                ),
                array(
                    'type'      => 'attachButton',
                    'href'      => $this->url()->fromRoute('admin/attachments-form', array(
                            'lang'      => 'it',
                            'module'    => 'amministrazione-trasparente',
                            'id'        => $record['id'],
                        )
                    ),
                ),
                array(
                    'type'      => 'tableButton',
                    'href'      => 'formdata/amministrazione-trasparente/'.$record['id'],
                    'title'     => 'Visualizza tabelle articolo'
                ),
            );
        }

        return $recordsToReturn;
    }
}
