<?php

namespace Admin\Model\FormData;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  18 May 2013
 */
class FormDataHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $formSetter = $this->getInput('formsetter', 1);
        $formSetterClassMap = array(
            'assistenza'        => 'Admin\Model\Assistenza\AssistenzaFormDataHandler',
            'posts'             => 'Admin\Model\Posts\PostsFormDataHandler',
            'albo-pretorio'     => 'Admin\Model\AlboPretorio\AlboPretorioFormData',
            'stato-civile'      => 'Admin\Model\StatoCivile\StatoCivileFormData',
            'amministrazione-trasparente' => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormData',
        );
        
        if (isset($formSetterClassMap[$formSetter])) {
            
            if ( class_exists($formSetterClassMap[$formSetter]) ) {
                $objectFormHandlerName = $formSetterClassMap[$formSetter];
                $objectFormHandler = new $objectFormHandlerName($this->getInput());
                
                $this->setVariable('form',              $objectFormHandler->getForm() );
                $this->setVariable('formAction',        $objectFormHandler->getFormAction() );
                $this->setVariable('formTitle',         $objectFormHandler->getTitle() );
                $this->setVariable('formDescription',   $objectFormHandler->getDescription() );
                $this->setVariable('closeFormOnSubmit', 0);
                
                $this->setTemplate('formdata/formdata.phtml');
            }
            
        }

        return $this->getOutput();
    }
}