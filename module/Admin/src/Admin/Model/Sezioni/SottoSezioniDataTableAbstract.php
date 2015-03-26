<?php

namespace Admin\Model\Sezioni;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  15 March 2015
 */
abstract class SottoSezioniDataTableAbstract extends DataTableAbstract
{
    /**
     * @param array $input
     * @return array
     */
    protected function setupPaginatorRecords($input = array())
    {
        $param = $this->getParam();

        $wrapper = new SottoSezioniGetterWrapper(new SottoSezioniGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
        $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

        return $wrapper->setupRecords();
    }

    /**
     * @param mixed $records
     * @return array
     */
    protected function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {
                $rowToAdd = array(
                    $row['nomeSottoSezione'],
                    $row['nomeSezione'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/sottosezioni-contenuti/'.$row['idSottoSezione'],
                        'title'     => 'Modifica'
                    ),
                );

                if ($this->isRole('WebMaster')) {
                    $rowToAdd[] = array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['idSottoSezione'],
                        'title'     => 'Elimina'
                    );
                }

                $arrayToReturn[] = $rowToAdd;
            }
        }

        return $arrayToReturn;
    }

    /**
     * @return array
     */
    protected function getHeaderColumns()
    {
        $columns = array(
            "Nome",
            "Sezione",
        );

        if ($this->getAcl()->hasResource('amministrazione_trsparente_sottosezioni_update')) {
            $columns[] = "&nbsp;";
        }

        if ($this->getAcl()->hasResource('amministrazione_trsparente_sottosezioni_delete')) {
            $columns[] = "&nbsp;";
        }

        return $columns;
    }
}