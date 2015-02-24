<?php

namespace Admin\Model\Contenuti;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * Contents from the old CMS
 *
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class ContenutiDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $paginatorRecords = $this->setupPaginatorRecords();

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $this->setVariables(array(
            'tablesetter' => 'contenuti',
            'paginator'   => $paginatorRecords,
            'columns'     => array(
                "Titolo",
                "Sezione",
                "Sotto sezione",
                'Data inserimento',
                'Data scadenza',
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
            ),
            ''
        ));

        $this->setTitle('Contenuti');
        $this->setDescription('Gestione contenuti');
        // $this->setTemplate('datatable/contenuti/datatable_contenuti.phtml');
    }

        /**
         * @param mixed $records
         * @return array
         */
        private function formatRecordsToShowOnTable($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $activeDisableButtonValue = ($row['attivo']!=0) ? 'toDisable' : 'toActive';
                    $arrayToReturn[] = array(
                        $row['titolo'],
                        $row['nomeSezione'],
                        $row['nomeSottosezione'],
                        $row['dataInserimento'],
                        $row['dataScadenza'],
                        array(
                            'type'      => $row['attivo']==1 ? 'disableButton' : 'activeButton',
                            'href'      => '',
                            'value'     => $row['attivo'],
                            'title'     => $row['attivo']==1 ? 'Nascondi contenuto' : 'Attiva contenuto',
                        ),
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contenuti/'.$row['id'],
                            'title'     => 'Modifica contenuto'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => $this->getInput('serviceLocator', 1)
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
                            'href'      => $this->getInput('baseUrl',1).'formdata/attachments/contenuti/'.$row['id'],
                        )
                    );
                }
            }

            return $arrayToReturn;
        }

        /**
         * @return array
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput(array());
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}