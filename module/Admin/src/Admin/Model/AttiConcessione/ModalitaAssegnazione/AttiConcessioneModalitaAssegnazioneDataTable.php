<?php

namespace Admin\Model\AttiConcessione\ModalitaAssegnazione;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  30 March 2015
 */
class AttiConcessioneModalitaAssegnazioneDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $wrapper = $this->setupPaginatorRecords();
        $paginatorRecords = $wrapper->setupRecords();
        $itemCount = $wrapper->getPaginator()->getTotalItemCount();

        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setTitle('Modalit&agrave; assegnazione atti di concessione');

        $this->setDescription($itemCount.' modalit&agrave; assegnazione atti di concessione presenti');

        $this->setColumns(array(
                "Nome",
                "",
                "",
            )
        );

        $this->setVariables(array(
                'tablesetter'           => 'atti-concessione',
                'paginator'             => $paginatorRecords,
                'paginatorItemCount'    => $itemCount
            )
        );

        $this->setTemplate('datatable/datatable_atti_concessione.phtml');

        if (!$this->getRecords()) {
            $this->setVariable('messageTitle', 'Nessun atto di concessione presente');
            $this->setVariable('messageDescription', 'Nessun atto di concessione presente in archivio');
        }
    }

    /**
     * @param array $records
     * @return array
     */
    private function getFormattedDataTableRecords($records)
    {
        $arrayToReturn = array();

        if ($records) {
            foreach($records as $key => $row) {

                $arrayToReturn[] = array(

                    utf8_encode($row['nome']),
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/atti-concessione/'.$row['id'],
                        'title'     => 'Modifica'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'title'     => 'Elimina',
                        'data-id'   => $row['id'],
                    ),
                );
            }
        }

        return $arrayToReturn;
    }

    /**
     * @return AttiConcessioneGetterWrapper
     */
    private function setupPaginatorRecords()
    {
        $param = $this->getParam();

        $wrapper = new AttiConcessioneModalitaAssegnazioneGetterWrapper(
            new AttiConcessioneModalitaAssegnazioneGetter($this->getInput('entityManager',1))
        );
        $wrapper->setInput($this->getInput());
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
        $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

        return $wrapper;
    }
}