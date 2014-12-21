<?php

namespace Admin\Model\AlboPretorio;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class AlboPretorioArticoliDataTable extends AlboPretorioDataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->param = $this->getParam();

        $this->checkActiveDisable();
        $this->checkPublish();
        $this->checkRevision();
        $this->checkAnnull();
        
        $this->recordsGetter = new AlboPretorioRecordsGetter($this->getInput());
        $this->recordsGetter->setArticoliInput($this->setupArticoliInput());
        $this->recordsGetter->setArticoliPaginator();
        $this->recordsGetter->setArticoliPaginatorCurrentPage(isset($this->param['route']['page']) ? $this->param['route']['page'] : null);
        $this->recordsGetter->setArticoliPaginatorPerPage(isset($this->param['route']['perpage']) ? $this->param['route']['perpage'] : null);

        $paginatorRecords = $this->recordsGetter->getPaginatorRecords();
        
        $this->setVariables(
            $this->recoverCommonColumnsAndProperties($paginatorRecords)
        );

        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setTemplate('datatable/datatable_albo_pretorio.phtml');
    }
}
