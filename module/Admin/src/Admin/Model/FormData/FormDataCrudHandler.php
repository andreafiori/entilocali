<?php

namespace Admin\Model\FormData;

use Application\Model\NullException;
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
     * Set Crud Handler Object
     *
     * @param array $classMap
     * @return array
     */
    public function detectCrudHandlerClassMap(array $classMap)
    {
        if (!$this->formCrudHandler) {
            throw new NullException('Form Crud Handler object is not set');
        }

        if (isset($classMap[$this->formCrudHandler])) {
            $this->crudHandler = $classMap[$this->formCrudHandler];
        }

        return $this->crudHandler;
    }
}
