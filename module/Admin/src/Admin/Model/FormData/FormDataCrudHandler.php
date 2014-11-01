<?php

namespace Admin\Model\FormData;

use Application\Model\RouterManagers\RouterManagerAbstract;

/**
 * Setup to handle CRUD request from forms on Backend
 * 
 * @author Andrea Fiori
 * @since  30 May 2014
 */
class FormDataCrudHandler extends RouterManagerAbstract
{
    private $formCrudHandler;
    private $crudHandler;
    
    /**
     * @param string $formCrudHandler
     * @return string
     */
    public function setFormCrudHandler($formCrudHandler)
     {
        $this->formCrudHandler = $formCrudHandler;

        return $this->formCrudHandler;
    }
    
    /**
     * @param array $classMap
     * @return array
     */
    public function detectCrudHandlerClassMap(array $classMap)
    {
        if (!$this->formCrudHandler) {
            throw new \Application\Model\NullException('Form Crud Handler is not set');
        }

        $this->crudHandler = $classMap[$this->formCrudHandler];

        return $this->crudHandler;
    }
}