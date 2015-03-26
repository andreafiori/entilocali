<?php

namespace Admin\Model\Sezioni;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class SezioniDataTable extends DataTableAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $paginatorRecords = $this->setupPaginatorRecords();

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $columns = array(
            "Nome",
            "Colonna",
            "URL",
            "Immagine",
            "&nbsp;",
        );

        if ($this->getAcl()->hasResource('contenuti_sezioni_delete')) {
            $columns[] = "&nbsp;";
        }

        $this->setVariables(array(
            'tablesetter' => 'sezioni-contenuti',
            'paginator'   => $paginatorRecords,
            'columns'     => $columns,
        ));

        $this->setTitle('Sezioni');

        $this->setDescription('Gestione sezioni');

        /* $this->setTemplate('datatable/datatable_sezioni.phtml'); */
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
                        $row['nome'],
                        $row['colonna'],
                        (!empty($row['url'])) ? '<a href="'.$row['url'].'" target="_blank" title="'.$row['url'].'">Vai al link</a>' : null,
                        !empty($row['image']) ?
                            '<img src="'.$this->getInput('basePath',1).'public/common/icons/'.$row['image'].'" alt="">'
                            : '&nbsp;',
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/sezioni-contenuti/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                    );

                    if ($this->getAcl()->hasResource('contenuti_sezioni_delete')) {
                        $rowToAdd[] = array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $row['id'],
                            'title'     => 'Elimina sezione'
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

            $wrapper = new SezioniGetterWrapper( new SezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}

