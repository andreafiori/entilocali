<?php

namespace Admin\Model\Sezioni;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SezioniDataTable extends DataTableAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->setTitle('Stato civile');
        $this->setDescription('Gestione atti stato civile');
        $this->setColumns( array(
            "Nome", 
            "Colonna", 
            "Posizione", 
            "Visualizza sul sito", 
            "Scadenza",
            "&nbsp;", 
            "&nbsp;",
            )
        );
        
        $formSearch = new StatoCivileFormSearch();
        $formSearch->addSubmitButton();
        $formSearch->addCheckExpired();
        $formSearch->addYears($this->getYears());
        
        $this->checkActiveDisable();
        
        $paginatorRecords = $this->getRecordsPaginator();
        
        $this->setVariables(array(
            'paginator'     => $paginatorRecords,
            'tablesetter'   => 'stato-civile',
            'formSearch'    => $formSearch,
            'formExport'    => $formSearch
            )
        );

        $this->setRecords($this->getFormattedRecords($paginatorRecords));
        
        $this->setTemplate('datatable/datatable_statocivile.phtml');
    }
}

