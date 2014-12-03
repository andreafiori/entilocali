<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Users\UserFormAuthentication;
use Zend\Session\Container as SessionContainer;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Admin\Model\Config\ConfigGetter;
use Admin\Model\Config\ConfigGetterWrapper;
use Application\Setup\UserInterfaceConfigurations;

/**
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class AuthController extends AbstractActionController
{
    /**
     * @var Application\Controller\Plugin\CommonSetupPlugin
     */
    private $commonSetupPlugin;
    
    private $moduleConfigs;
    private $configurations;
    private $input;
    private $baseUrl;
    private $authservice;
    private $form;
    private $storage;
    
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function loginAction()
    {
        if ($this->getAuthService()->hasIdentity()) {
            return $this->redirect()->toRoute('admin');
        }            

        $appServiceLoader = $this->recoverAppServiceLoader();

        $this->layout()->setVariable('form',     $this->getUserFormAuthentication());
        $this->layout()->setVariable('messages', $this->flashMessenger()->getMessages());
        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'login.phtml');

        return new ViewModel();
    }
    
    /**
     * @return Redirect
     * @throws Exception
     */
    public function authenticateAction()
    {
        $form       = $this->getUserFormAuthentication();
        $redirect   = 'login';
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // check authentication...
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));
         
                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                {
                    // save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }
                
                if ($result->isValid()) {
                    $redirect = 'admin';
                    
                    // set session timeout
                    $this->getSessionStorage()
                         ->setRememberMe();
                    
                    // set storage again
                    $this->getAuthService()->setStorage($this->getSessionStorage());
                    
                    $this->getAuthService()->setStorage($this->getSessionStorage());
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                    
                    // get user data
                    $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default')) );
                    $usersGetterWrapper->setInput( array('username' => $request->getPost('username'), 'password' => $request->getPost('password'), 'limit'=>1) );
                    $usersGetterWrapper->setupQueryBuilder();
                    
                    $records = $usersGetterWrapper->getRecords();
                    if ( isset($records) and count($records)==1 ) {
                        $records = $records[0];
                        
                        $sessionContainer = new SessionContainer();
                        $sessionContainer->offsetSet('id', $records['id']);
                        $sessionContainer->offsetSet('name', $records['name']);
                        $sessionContainer->offsetSet('surname', $records['surname']);
                        $sessionContainer->offsetSet('email', $records['email']);
                        
                        /* Regenerate Session ID after log in */
                        $manager = new \Zend\Session\SessionManager;
                        $manager->regenerateId();
                        
                    } else {
                        throw new Exception('Cannot get user details after login');
                    }
                }
            } else {
                // TODO: after 3 failures the login form must show a captcha...
                $sessionContainer = new Container();
                $loginFailures = $sessionContainer->offsetGet('loginFailures');
                $sessionContainer->offsetSet('loginFailures', $loginFailures);
                
                foreach($form->getMessages() as $message) {
                    $this->flashmessenger()->addMessage(print_r($message,1));
                }
            }
        }
        
        return $this->redirect()->toRoute($redirect, array("lang" => 'it'));
    }
    
    /**
     * @return redirect
     */
    public function logoutAction()
    {
        if ($this->getAuthService()->hasIdentity()) {
            $this->getSessionStorage()->forgetMe();
            $this->getAuthService()->clearIdentity();
            $this->flashmessenger()->addMessage("Uscita dall'area di amministrazione");
        }
        
        return $this->redirect()->toRoute('login');
    }
    
        /**
         * @return \Zend\Authentication\AuthenticationService
         */
        private function getAuthService()
        {
            try {
                if (!$this->authservice) {
                    $this->authservice = $this->getServiceLocator()->get('AuthService');
                }
                return $this->authservice;
            } catch (Exception $ex) {
                
            }
        }

        /**
         * @return \Admin\Model\MyAuthStorage
         */
        private function getSessionStorage()
        {
            if (!$this->storage) {
                $this->storage = $this->getServiceLocator()->get('Admin\Model\MyAuthStorage');
            }

            return $this->storage;
        }

        /**
         * @return \Admin\Model\Users\UserFormAuthentication
         */
        private function getUserFormAuthentication()
        {
            if (!$this->form) {  
                $this->form = new UserFormAuthentication();

                return $this->form;
            }
        }

        /**
         * @return AppServiceLoader
         */
        private function recoverAppServiceLoader()
        {
            $appServiceLoader = $this->getServiceLocator()->get('PluginManagerFactory')->get(
                'appserviceloader',
                array('')
            );
            
            $appServiceLoader->setService('serviceLocator',  $this->getServiceLocator());
            $appServiceLoader->setService('serviceManager',  $this->getServiceLocator()->get('servicemanager'));
            $appServiceLoader->setService('entityManager',   $this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
            $appServiceLoader->setService('translator',      $this->getServiceLocator()->get('translator'));
            $appServiceLoader->setService('queryBuilder',    $appServiceLoader->recoverService('entityManager')->createQueryBuilder());
            $appServiceLoader->setService('moduleConfigs',   $appServiceLoader->recoverService('serviceManager')->get('config'));
            $appServiceLoader->setService('request',         $appServiceLoader->recoverService('serviceManager')->get('request'));
            $appServiceLoader->setService('router',          $appServiceLoader->recoverRouter());
            $appServiceLoader->setService('routeMatch',      $appServiceLoader->recoverRouteMatch() );
            $appServiceLoader->setService('channel', 1);
            $appServiceLoader->setController($this);
            $appServiceLoader->setupParams();
            $appServiceLoader->setupRedirect();
            $appServiceLoader->setupConfigurations(new ConfigGetterWrapper(new ConfigGetter($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'))));
            $appServiceLoader->setupUserInterfaceConfigurations(new UserInterfaceConfigurations($appServiceLoader->getProperties()));
            
            return $appServiceLoader;
        }
}
