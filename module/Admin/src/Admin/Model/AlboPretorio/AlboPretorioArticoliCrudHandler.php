<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  30 October 2014
 */
class AlboPretorioArticoliCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    protected function insert()
    {
        
    }
    
    protected function update()
    {
        var_dump($this->rawPost);
    }
    
    protected function delete()
    {
        
    }
}

