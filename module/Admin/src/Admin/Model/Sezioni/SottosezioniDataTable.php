<?php

namespace Admin\Model\Sezioni;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class SottosezioniDataTable extends DataTableAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getParam();

        $paginatorRecords = $this->setupPaginatorRecords();

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $columns = array(
            // "Immagine",
            "Nome",
            "Sezione",
            "&nbsp;",
        );

        if ($this->isRole('WebMaster')) {
            $columns[] = "&nbsp;";
        }

        $this->setVariables(array(
            'tablesetter' => $param['route']['tablesetter'],
            'paginator'   => $paginatorRecords,
            'columns'     => $columns
        ));

        $this->setTitle('Sotto sezioni');

        $this->setDescription('Gestione sotto sezioni');
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
                $rowToAdd = array(
                    // $row['immagine'],
                    $row['nomeSottosezione'],
                    $row['nomeSezione'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/sottosezioni-contenuti/'.$row['idSottosezione'],
                        'title'     => 'Modifica'
                    ),
                );

                if ($this->isRole('WebMaster')) {
                    $rowToAdd[] = array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['idSottosezione'],
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
    private function setupPaginatorRecords($input = array())
    {
        $param = $this->getParam();

        $wrapper = new SottoSezioniGetterWrapper(new SottoSezioniGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
        $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

        return $wrapper->setupRecords();
    }
}