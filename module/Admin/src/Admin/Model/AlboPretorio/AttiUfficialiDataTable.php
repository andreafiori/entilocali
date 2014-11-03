<?php

namespace Admin\Model\AlboPretorio;

/**
 * @author Andrea Fiori
 * @since  02 November 2014
 */
class AttiUfficialiDataTable extends AlboPretorioDataTableAbstract
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
            array(
                'tableTitle'        => 'Atti ufficiali',
                'tableDescription'  => 'Elenco atti albo pretorio. Effettuando una ricerca, le informazioni vengono memorizzate.',
                'tablesetter'       => 'albo-pretorio',
                'columns' => array(
                    array('label' => 'Num \ Anno', 'width' => '10%'),
                    array('label' => 'Titolo', 'width' => '44%'),
                    'Settore',
                    'Scadenza',
                    'Data attivazione',
                    'Inserito da',
                    '&nbsp;',
                    '&nbsp;',
                    '&nbsp;',
                    '&nbsp;'
                ),
                
                'paginator'   => $paginatorRecords,
                'formSearch'  => $this->setupFormSearchAndExport(new AlboPretorioArticoliSearchFilterForm()),
                'formExport'  => $this->setupFormSearchAndExport(new AlboPretorioArticoliSearchFilterForm(), 'export', 'Esporta'),
            )
        );

        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );
        
        $this->setTemplate('datatable/datatable_albo_pretorio.phtml');
    }
}