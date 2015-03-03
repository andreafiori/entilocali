<?php

namespace Admin\Model;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
abstract class InputSetterGetterAbstract
{
    protected $input;

    /**
     * @param array $input
     */
    public function setInput(array $input)
    {
        $this->input = array_filter($input);
        
        return $this->input;
    }

    /**
     * @param array $key
     * @param int $noArray
     * @return mixed
     */
    public function getInput($key = null, $noArray = 0)
    {
        return $this->getArrayValue($this->input, $key, $noArray);
    }

    /**
     * @param array $array
     * @param string $key
     * @param int $noArray
     * @return array
     */
    protected function getArrayValue($array, $key = null, $noArray = null)
    {
        if ( isset($array[$key]) ) {
            return $array[$key];
        }

        if ( !$noArray ) {
            return $array;
        }

        return null;
    }
}
