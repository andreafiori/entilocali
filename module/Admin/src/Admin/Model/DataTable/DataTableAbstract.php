<?php

namespace Admin\Model\DataTable;

use Admin\Model\VarExporter;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
abstract class DataTableAbstract extends VarExporter
{
    protected $param;
    
    protected $columns;
    
    protected $defaultDataTable = 'datatable/datatable.phtml';

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->param = $this->getInput('param', 1);
        
        $this->setTemplate($this->defaultDataTable);
    }
    
    /**
     * @param array $param
     */
    public function setParam($param)
    {
        $this->param = $param;
        
        return $this->param;
    }
    
    /**
     * @param string $key
     * @return array
     */
    public function getParam($firstKey = null, $secondKey = null)
    {
        if ( isset($this->param[$firstKey]) and !$secondKey) {
            return $this->param[$firstKey];
        }
        
        if ( isset($this->param[$firstKey][$secondKey]) ) {
            return $this->param[$firstKey][$secondKey];
        }
        
        return $this->param;
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;
        
        return $this->columns;
    }

    /**
     * @return type
     */
    public function getColumns()
    {
        return $this->columns;
    }
    
    /**
     * Overwrite parent getTemplate
     * 
     * @return string
     */
    public function getTemplate()
    {
		/*
        if ( !$this->getRecords() ) {
            return $this->defaultDataTable;
        }
        */
        return $this->template;
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