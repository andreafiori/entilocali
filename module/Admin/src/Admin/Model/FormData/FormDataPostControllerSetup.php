<?php

namespace Admin\Model\FormData;

use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * Setup operations for the formPostData Controller
 *
 * @author Andrea Fiori
 * @since  22 March 2015
 */
class FormDataPostControllerSetup
{
    private $crudHandler;

    public function __construct(CrudHandlerAbstract $crudHandler)
    {
        $this->crudHandler = $crudHandler;
    }

    /**
     * @return CrudHandlerAbstract
     */
    public function getCrudHandler()
    {
        return $this->crudHandler;
    }
}