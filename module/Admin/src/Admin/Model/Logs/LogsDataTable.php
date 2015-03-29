<?php

namespace Admin\Model\Logs;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 February 2015
 */
class LogsDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        if ( isset($this->param['post']['deleteAllLogs']) ) {
            $this->deleteAllLogs();
        }

        $paginatorRecords = $this->setupPaginatorRecords();

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $this->setVariables(array(
            'tablesetter' => 'logs',
            'paginator'   => $paginatorRecords,
            'columns'     => array(
                "Data \ ora",
                "Messaggio",
                "Utente",
                "Tipo",
                "Area",
                "&nbsp;",
            ),
            ''
        ));

        $this->setTitle('Logs');

        $this->setDescription('Visualizzazione logs');

        $this->setTemplate('datatable/datatable_logs.phtml');
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

                $arrayToReturn[]  = array(
                    $row['datetime'],
                    $row['message'],
                    $row['name'].' '.$row['surname'],
                    $row['type'],
                    $row['backend'],
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['id'],
                        'title'     => 'Elimina log'
                    ),
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

        $wrapper = new LogsGetterWrapper( new LogsGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput(array());
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
        $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

        return $wrapper->setupRecords();
    }

    /**
     * Truncate table logs
     */
    private function deleteAllLogs()
    {
        $em = $this->getInput('entityManager',1);
        $connection = $em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->beginTransaction();
        try {
            $connection->query('SET FOREIGN_KEY_CHECKS=0');

            $q = $dbPlatform->getTruncateTableSql('zfcms_logs');

            $connection->executeUpdate($q);
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
            $connection->commit();
        }
        catch (\Exception $e) {
            $connection->rollback();
        }
    }
}