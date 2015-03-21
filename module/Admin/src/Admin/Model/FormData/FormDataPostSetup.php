<?php

namespace Admin\Model\FormData;

use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * Setup operations for the formPostData Controller
 */
class FormDataPostsControllerSetup
{
    private $crudHandler;

    public function __construct(CrudHandlerAbstract $crudHandler)
    {
        $this->crudHandler = $crudHandler;
    }

}