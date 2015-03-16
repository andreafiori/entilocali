<?php

namespace Admin\Model\Sezioni;

/**
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class SottosezioniContenutiDataTable extends SottoSezioniDataTableAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getParam();

        $paginatorRecords = $this->setupPaginatorRecords(array(
            'sezioneId' => isset($param['get']['amm-trasp']) ? $param['get']['amm-trasp'] : null,
        ));

        $this->setTitle('Sotto sezioni contenuti');

        $this->setDescription('Gestione sotto sezioni contenuti');

        $this->setVariables(array(
            'tablesetter' => $param['route']['tablesetter'],
            'paginator'   => $paginatorRecords,
            'records'     => $this->formatRecordsToShowOnTable($paginatorRecords),
            'columns'     => $this->getHeaderColumns(),
        ));
    }
}
