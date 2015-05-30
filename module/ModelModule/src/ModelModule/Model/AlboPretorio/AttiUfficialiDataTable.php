<?php

namespace ModelModule\Model\AlboPretorio;

/**
 * @author Andrea Fiori
 * @since  02 November 2014
 */
class AttiUfficialiDataTable extends AlboPretorioArticoliDataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->param = $this->getParam();
        
        $this->recordsGetter = new AlboPretorioRecordsGetter($this->getInput());
        $this->recordsGetter->setArticoliInput($this->setupArticoliInput());
        $this->recordsGetter->setArticoliPaginator();
        $this->recordsGetter->setArticoliPaginatorCurrentPage(isset($this->param['route']['page']) ? $this->param['route']['page'] : null);
        $this->recordsGetter->setArticoliPaginatorPerPage(isset($this->param['route']['perpage']) ? $this->param['route']['perpage'] : null);

        $paginatorRecords = $this->recordsGetter->getPaginatorRecords();
        
        $this->setVariables(
            $this->recoverCommonColumnsAndProperties($paginatorRecords, 'Atti Ufficiali')
        );

        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );
        
        // $this->setTemplate('datatable/datatable_albo_pretorio.phtml');
    }
}