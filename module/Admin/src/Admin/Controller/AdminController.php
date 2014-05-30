<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;

/**
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class AdminController extends AbstractActionController
{
    private $commonSetupPlugin;    
    private $configurations;
    private $input;
    private $baseUrl;
    
    public function indexAction()
    {
        // Check login
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        
        $this->initialize();
        
        $routerManager = new RouterManager($this->configurations);
        $routerManager->setRouteMatchName($this->config['be_router']);
        
        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput($this->input);
        $routerManagerHelper->getRouterManger()->setupRecord();
        
        $output = $routerManagerHelper->getRouterManger()->getOutput('export');
        if ( isset($output) ) {
            foreach($output as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }
        
        $templatePartial = $routerManagerHelper->getRouterManger()->getTemplate(1);
        if ( !isset($templatePartial) ) {
            $templatePartial = $dashboard = 'dashboard/dashboard.phtml';
        }
        
        $this->layout()->setVariable('baseUrl', $this->baseUrl);
        $this->layout()->setVariable('preloadResponse', $this->configurations['preloadResponse']);
        $this->layout()->setVariable('templatePartial', 'backend/templates/'.$this->configurations['template_backend'].$templatePartial);
        $this->layout('backend/templates/'.$this->configurations['template_backend'].'backend.phtml');
        
    	return new ViewModel();
    }
    
    /**
     * TODO:
            validate form w jquery validation
            set inputFilterValidator if needed
            show errors if occured
            initialize class to process posted array\data
            show result
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function formpostAction()
    {
        // Check login
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        
        // Check POST request
        if ( !$this->getServiceLocator()->get('request')->isPost() ) {
            return $this->redirect()->toRoute('login');
        }
        
        $this->initialize();
        
        $connection     = $this->commonSetupPlugin->getEntityManager()->getConnection();
 
        $rawPost = (array) $this->getRequest()->getPost();
        $formPostHandler = $this->params()->fromRoute('form_post_handler');
        $operation       = $this->params()->fromRoute('operation');
        
        if ($formPostHandler == 'posts') {
            
            if ($operation=='insert') {
                // insert posts
                // insert posts_opzioni
                // insert posts_relations
                // upload an image?
                $messageType = 'warning';
                $messageTitle = 'In costruzione';
                $messageText = 'Funzione attualmente in costruzione';
                
            } elseif ($operation=='update') {
                try {
                    $affectedRows = $connection->update('posts_opzioni', array(
                        'titolo'            => $rawPost['titolo'],
                        'descrizione'       => $rawPost['descrizione'],
                        'seo_description'   => $rawPost['seoDescription'],
                        'seo_keywords'      => $rawPost['seoKeywords'],
                    ), array('posts_id' => $rawPost['postoptionid']) );
                } catch(\Exception $e) {
                    $error = $e->getMessage();
                }
                
                if ($error) {
                    $messageType = 'danger';
                    $messageTitle = 'Errore aggiornamento dati';
                    $messageText = "Si &egrave; verificato un errore nell'aggiornamento dati in archivio: ".$error;
                } else {
                    $messageType = 'success';
                    $messageTitle = 'Dati aggiornati correttamente';
                    $messageText = 'Dati in archivio aggiornati correttamente';
                }
            }
            
            $this->layout()->setVariable('messageType', $messageType);
            $this->layout()->setVariable('messageTitle', $messageTitle);
            $this->layout()->setVariable('messageText', $messageText);
            $this->layout('backend/templates/'.$this->configurations['template_backend'].'message.phtml');
            
        }
        
        return new ViewModel();
    }

        /**
         * Setup Common Plugin, service locator and input
         */
        private function initialize()
        {
            $this->commonSetupPlugin  = $this->CommonSetupPlugin();
            $this->configurations     = $this->commonSetupPlugin->recoverConfigurationsRecord();
            $this->commonSetupPlugin->setConfigurationsVariables();
            
            $this->config = $this->getServiceLocator()->get('config');
            
            $this->input = $this->commonSetupPlugin->mergeInput( array_merge($this->configurations, array(
                    'formsetter'            => trim($this->params()->fromRoute('formsetter')),
                    'tablesetter'           => trim($this->params()->fromRoute('tablesetter')),
            ), array('formdata_classmap'     => $this->config['formdata_classmap'],
                    'formdata_post'         => $this->config['formdata_post'],
                    'datatables_classmap'   => $this->config['datatables_classmap']) ));
            $this->baseUrl = sprintf('%s://%s%s', $this->input['uri']->getScheme(), $this->input['uri']->getHost(), $this->input['request']->getBaseUrl()).'/admin/main/'.$this->params()->fromRoute('lang').'/';
            $this->input = array_merge($this->input, array("baseUrl" => $this->baseUrl));
        }

}
