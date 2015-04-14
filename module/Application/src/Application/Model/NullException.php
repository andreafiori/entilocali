<?php

namespace Application\Model;

/**
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class NullException extends \Exception
{
    private $params;

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
