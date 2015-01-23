<?php

namespace Admin\Model\Sezioni;

use Doctrine\Common\Collections\Collection;

/**
 * Get tree profondita
 * 
 */
class SottoSezioniRecursiveIterator implements \RecursiveIterator
{
    private $_data;
    
    /**
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        $this->_data = $data;
    }

    public function hasChildren()
    {
        return ( !$this->_data->current()->getProfonditaDa()->isEmpty() );
    }

    public function getChildren()
    {
        return new RecursiveCategoryIterator($this->_data->current()->getProfonditaDa());
    }

    public function current()
    {
        return $this->_data->current();
    }

    public function next()
    {
        $this->_data->next();
    }

    public function key()
    {
        return $this->_data->key();
    }

    public function valid()
    {
        return $this->_data->current() instanceof \Appllication\Entity\Sottosezioni;
    }

    public function rewind()
    {
        $this->_data->first();
    }
}