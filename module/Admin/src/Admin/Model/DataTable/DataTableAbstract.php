<?php

namespace Admin\Model\DataTable;

use Admin\Model\InputSetupAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
abstract class DataTableAbstract extends InputSetupAbstract
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
    
    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        
        return $this->template;
    }

    /**
     * @return string $this->template
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    abstract public function getColumns();
    
    abstract public function getRecords();
}