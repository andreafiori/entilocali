<?php

namespace Admin\Model\DataTable;

use Admin\Model\VarExporter;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
abstract class DataTableAbstract extends VarExporter
{
    protected $columns;

    protected $template = 'datatable/datatable.phtml';
    
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    public function getColumns()
    {
        return $this->columns;
    }

        /**
         * @param \DateTime $dateTime
         * @return type
         */
        protected function convertDateTimeToString($dateTime)
        {
            if ($dateTime instanceof \DateTime) {
                return $dateTime->format('d-m-Y');
            }
        }
}