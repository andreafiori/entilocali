<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;

/**
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class AdminController extends AbstractActionController
{
    public function indexAction()
    {
        // Check login
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        
        $commonSetupPlugin  = $this->CommonSetupPlugin();
        $configurations     = $commonSetupPlugin->recoverConfigurationsRecord();
        $commonSetupPlugin->setConfigurationsVariables();
        
        // Can use the RouterManager to handle Requests
        switch($configurations['routeMatchName']):
            default: case("admin"):
                // TODO: load dashboard records...
                
            break;
        
            case("admin/formdata"):
                // TODO:
                // check if can show form with ACL
                // check id with data -> hydrate form with data if set
       
                if ( $this->params()->fromRoute('formsetter') == 'assistenza' ) {
                    $assistenzaForm = new \Admin\Model\Assistenza\AssistenzaForm();
                }
                
                $this->layout()->setVariable('form',            $assistenzaForm);
                // $this->layout()->setVariable('formAction',    '');
                $this->layout()->setVariable('formTitle',       'Assitenza');
                $this->layout()->setVariable('formDescription', 'Nuova richiesta di assistenza');
                //$this->layout()->setVariable('closeFormOnSubmit', 'Assitenza');
                
                $templatePartial = 'backend/templates/default/formdata/form.phtml';
            break;
        
            case("datatable"):
                // TODO:
                // check if can show the grid
                // 
            break;
        endswitch;
        
        if ( !isset($templatePartial) ) {
            $dashboard = 'backend/templates/'.$configurations['template_backend'].'dashboard/dashboard.phtml';
            $templatePartial = $dashboard;
        }

        $this->layout()->setVariable('langFromRoute', $this->params()->fromRoute('lang') );
        $this->layout()->setVariable('preloadResponse', $configurations['preloadResponse']);
        $this->layout()->setVariable('templatePartial', $templatePartial);
        $this->layout('backend/templates/'.$configurations['template_backend'].'backend.phtml');
        
    	return new ViewModel();
    }
    
    public function formpostAction()
    {
        
    }
    
}
