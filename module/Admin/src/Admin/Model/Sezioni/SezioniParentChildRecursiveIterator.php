<?php

namespace Application\Repository;

use Doctrine\Common\Collections\Collection;

/**
 * @author Andrea Fiori
 * @since  17 March 2015
 */
class SezioniParentChildRecursiveIterator implements \RecursiveIterator
{
    private $_data;

    /**
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        $this->_data = $data;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !$this->_data->current()->getProfonditaDa()->isEmpty();
    }

    /**
     * @return ParentChildRecursiveIterator
     */
    public function getChildren()
    {
        return new ParentChildRecursiveIterator($this->_data->current()->getProfonditaDa());
    }

    public function current()
    {
        return $this->_data->current();
    }

    public function next()
    {
        $this->_data->next();
    }

    /**
     * @return int|string
     */
    public function key()
    {
        return $this->_data->key();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->_data->current() instanceof \Application\Entity\ZfcmsComuniSottosezioni;
    }

    public function rewind()
    {
        $this->_data->first();
    }
}
