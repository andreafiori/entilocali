<?php

namespace Application\Model;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
abstract class RecordsGetterWrapperAbstract
{
    protected $input;

    /**
     * @param array $input
     */
    public function setInput(array $input)
    {
        $this->input = $input;
        
        return $this->input;
    }
    
    /**
     * 
     * @param string $key
     * @param 0 or 1 or array
     * @return types
     */
    public function getInput($key = null, $noArray = null)
    {
        if ( isset($this->input[$key]) ) {
            return $this->input[$key];
        }
        
        if (!$noArray) {
            return $this->input;
        }
    }
    
    abstract public function setupQueryBuilder();
}