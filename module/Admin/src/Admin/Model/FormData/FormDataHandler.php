<?php

namespace Admin\Model\FormData;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class FormDataHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $formSetter         = $this->getInput('formsetter', 1);
        $formSetterClassMap = $this->getInput('formdata_classmap', 1);
        
        if (isset($formSetterClassMap[$formSetter])) {
            
            if ( class_exists($formSetterClassMap[$formSetter]) ) {
                
                $objectFormHandlerName = $formSetterClassMap[$formSetter];
                $objectFormHandler = new $objectFormHandlerName($this->getInput());
                
                $this->exportVariableAsGlobal( $objectFormHandler->getVarToExport() );
                
                if ($this->getVariable('error')) {
                    $this->setTemplate('message.phtml');
                    return;
                }
                
                $this->setTemplate('formdata/formdata.phtml');
            }
            
        }

        return $this->getOutput();
    }
}