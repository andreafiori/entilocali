<?php

namespace Admin\Model\DataTable;

interface DataTableInterface
{
    public function getColumns();
    
    public function getDescription();
    
    public function getRecords();
}
