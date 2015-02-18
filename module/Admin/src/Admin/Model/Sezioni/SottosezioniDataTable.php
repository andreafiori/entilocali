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

        $paginatorRecords = $this->setupPaginatorRecords();

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $this->setVariables(array(
            'tablesetter' => 'sottosezioni-contenuti',
            'paginator'   => $paginatorRecords,
            'columns'     => array(
                "Immagine",
                "Nome",
                "Sezione",
                "&nbsp;",
                "&nbsp;",
            ),
            ''
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
                $arrayToReturn[] = array(
                    $row['immagine'],
                    $row['nomeSottosezione'],
                    $row['nomeSezione'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/sottosezioni-contenuti/'.$row['idSottosezione'],
                        'title'     => 'Modifica'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['idSottosezione'],
                        'title'     => 'Elimina'
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

        $wrapper = new SottoSezioniGetterWrapper(new SottoSezioniGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput( array() );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
        $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

        return $wrapper->setupRecords();
    }
}