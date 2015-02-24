<?php

namespace Admin\Controller;

use Admin\Model\Config\ConfigGetter;
use Admin\Model\Config\ConfigGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\NullException;
use Zend\View\Model\ViewModel;
use Admin\Model\Users\UserFormAuthentication;
use Zend\Session\Container as SessionContainer;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use \Exception;

/**
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class AuthController extends SetupAbstractController
{
    private $authservice;
    private $form;
    private $storage;
    
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function showFormLoginAction()
    {
        if ( $this->checkLogin() ) {
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
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                    
                    // Get user data
                    $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default')) );
                    $usersGetterWrapper->setInput( array(
                        'username'  => $request->getPost('username'),
                        'password'  => $request->getPost('password'),
                        'limit'     => 1,
                    ));
                    $usersGetterWrapper->setupQueryBuilder();

                    $records = $usersGetterWrapper->getRecords();

                    if ( isset($records) and count($records)==1 ) {
                        $records = $records[0];

                        /* Set ACL */
                        $acl = new Acl();
                        $userRole = new Role('administrator');
                        $acl->addRole($userRole);
                        $acl->allow($userRole);
                        // $acl->isAllowed($userRole, null, 'view');

                        $sitename = $this->recoverSitename();

                        if (!$sitename) {
                            throw new NullException('Site name is not set. Cannot complete the login');
                        }

                        $sessionContainer = new SessionContainer();
                        $sessionContainer->offsetSet('sitename', $sitename);
                        $sessionContainer->offsetSet('id',      $records['id']);
                        $sessionContainer->offsetSet('name',    $records['name']);
                        $sessionContainer->offsetSet('surname', $records['surname']);
                        $sessionContainer->offsetSet('email',   $records['email']);
                        $sessionContainer->offsetSet('role',    $userRole);
                        $sessionContainer->offsetSet('acl',     $acl);

                        // $sessionContainer->offsetSet('userDetails_$sitename', $acl);
                        // $sessionContainer->offsetSet('currentSitename', $sitename);
                        
                        /* Regenerate Session ID after login */
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
                    $this->flashmessenger()->addMessage( print_r($message,1) );
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
            if (!$this->authservice) {
                $this->authservice = $this->getServiceLocator()->get('AuthService');
            }
            return $this->authservice;
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
}
