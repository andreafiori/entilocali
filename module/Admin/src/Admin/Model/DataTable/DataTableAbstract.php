<?php

namespace Admin\Model\DataTable;

use Admin\Model\InputSetupTemplateAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
abstract class DataTableAbstract extends InputSetupTemplateAbstract
{
    protected $title;
    
    protected $description;
    
    protected $template = 'datatable/datatable.phtml';
    
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
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    abstract public function getColumns();
    
    abstract public function getRecords();
}