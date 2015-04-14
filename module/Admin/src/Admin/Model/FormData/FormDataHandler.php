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
    private $formSetter;

    /**
     * @return bool|mixed
     */
    public function setupRecord()
    {
        $formSetterInput    = $this->getInput('formsetter', 1);
        $formSetterClassMap = $this->getInput('formdata_classmap', 1);

        $this->setFormSetter(isset($formSetterClassMap[$formSetterInput]) ? $formSetterClassMap[$formSetterInput] : null);
        $this->checkFormSetterClassExists();

        $formSetter = $this->getFormSetter();
        if (isset($formSetter)) {

            /**
             * @var \Admin\Model\FormData\FormDataAbstract $objectFormHandler
             */
            $objectFormHandler = new $formSetter($this->getInput());

            $this->exportVariableAsGlobal( $objectFormHandler->getVarToExport() );

            if ($this->getVariable('error')) {
                $this->setTemplate('message.phtml');
                return false;
            }

            $customTemplate = $objectFormHandler->getTemplate();
            if ($customTemplate) {
                $this->setTemplate($customTemplate);
            } else {
                $this->setTemplate('formdata/formdata.phtml');
            }

            $this->setVariable('formDataCommonPath', 'backend/templates/common/');
        } else {
            // Message or redirect here...
            $this->setVariables(array(
                'messageType'   => 'danger',
                'messageTitle'  => 'Form non rilevato',
                'messageText'   => 'Form non presente in questa pagina'
            ));
            $this->setTemplate('message.phtml');
        }

        return $this->getOutput();
    }
    
    /**
     * @param string $formSetterClassMap
     */
    public function setFormSetter($formSetterClassMap)
    {
        if ($formSetterClassMap) {
            $this->formSetter = $formSetterClassMap;
        }

        return null;
    }
    
    /**
     * @return string|null
     */
    public function getFormSetter()
    {
		if (isset($this->formSetter)) {
			return $this->formSetter;
		}

        return null;
    }
    
    /**
     * @return string|null
     */
    public function checkFormSetterClassExists()
    {
        $formSetter = $this->getFormSetter();
        if (class_exists($formSetter)) {
            return $formSetter;
        } else {
            unset($this->formSetter);
        }

        return null;
    }
}
