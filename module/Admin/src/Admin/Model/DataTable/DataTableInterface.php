<?php

namespace Admin\Model\DataTable;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
interface DataTableInterface
{
    public function getTitle();
    
    public function getDescription();
    
    public function getColumns();
    
    public function getRecords();
}