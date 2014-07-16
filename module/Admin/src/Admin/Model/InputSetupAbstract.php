<?php

namespace Admin\Model;

/**
 * @author Andrea Fiori
 * @since  20 May 2014
 */
abstract class InputSetupAbstract
{
    protected $input;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }
    
    /**
     * @param string $key
     * @param 1 or 0 $noArray
     * @return array, null or string
     */
    public function getInput($key = null, $noArray = null)
    {
        if (isset($this->input[$key])) {
            return $this->input[$key];
        }
        
        if (!$noArray) {
            return $this->input;
        }
    }
}
