<?php

namespace Admin\Model\Contenuti;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * Contenuti from the old CMS
 *
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class ContenutiDataTable extends DataTableAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        /* Check ACL */
        if (!$this->getAcl()->hasResource('contenuti_update')) {
            // $redirect = $this->getInput('redirect', 1);
            return false;
        }

        $configurations = $this->getInput('configurations', 1);

        $paginatorRecords = $this->setupPaginatorRecords(array(
            'orderBy'               => 'contenuti.id DESC',
            'excludeSottosezioneId' => isset($configurations['amministrazione_trasparente_sottosezione_id']) ? $configurations['amministrazione_trasparente_sottosezione_id'] : null,
            'excludeSezioneId'      => isset($configurations['amministrazione_trasparente_sezione_id']) ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'showToAll'             => ($this->isRole(array('WebMaster'))) ? null : 1,
            'utente'                => ($this->isRole(array('WebMaster'))) ? null : $this->getUserDetails()->id
        ));

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
                'Inserito da',
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

        return null;
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
                    // $activeDisableButtonValue = ($row['attivo']!=0) ? 'toDisable' : 'toActive';
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
         * @param array $input
         * @return \stdClass
         */
        private function setupPaginatorRecords($input = array())
        {
            $param = $this->getParam();

            $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}