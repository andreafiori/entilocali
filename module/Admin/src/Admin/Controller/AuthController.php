<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container as SessionContainer;
use Zend\Permissions\Acl\Acl;
use Application\Controller\SetupAbstractController;
use Admin\Model\Users\UserFormAuthentication;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Admin\Model\Users\AclSetter;
use Admin\Model\Users\Roles\UsersRolesGetter;
use Admin\Model\Users\Roles\UsersRolesGetterWrapper;
use Admin\Model\Users\Roles\UsersRolesPermissionsGetter;
use Admin\Model\Users\Roles\UsersRolesPermissionsGetterWrapper;
use Admin\Model\Users\Roles\UsersRolesPermissionsRelationsGetter;
use Admin\Model\Users\Roles\UsersRolesPermissionsRelationsGetterWrapper;
use Application\Model\NullException;
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

        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        /* Preview Password Area */
        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            return $this->redirect()->toRoute('password-preview');
        }

        $this->layout()->setVariables($configurations);
        $this->layout()->setVariables(
            array(
                'form'      => $this->getUserFormAuthentication(),
                'messages'  => $this->flashMessenger()->getMessages(),
            )
        );
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
        $request    = $this->getRequest();
        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // check authentication...
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));

                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message) {
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
                    $usersGetterWrapper = new UsersGetterWrapper(
                        new UsersGetter($entityManager)
                    );
                    $usersGetterWrapper->setInput( array(
                        'username'      => $request->getPost('username'),
                        'password'      => $request->getPost('password'),
                        'adminAccess'   => 1,
                        'limit'         => 1,
                    ));
                    $usersGetterWrapper->setupQueryBuilder();

                    $records = $usersGetterWrapper->getRecords();

                    if ( isset($records) and count($records)==1 ) {
                        $records = $records[0];

                        /* Set ACL */
                        $aclSetter = new AclSetter(new Acl());
                        $aclSetter->setUsersRolesGetterWrapper(new UsersRolesGetterWrapper(
                                new UsersRolesGetter($entityManager)
                            )
                        );
                        $aclSetter->addRoles($aclSetter->recoverRoles(array()));

                        if ($records['roleName']==='WebMaster') {
                            // Assign all permissions...
                            $wrapper = new UsersRolesPermissionsGetterWrapper(
                                new UsersRolesPermissionsGetter($entityManager)
                            );
                            $wrapper->setInput(array());
                            $wrapper->setupQueryBuilder();

                            $permissionsRecords = $wrapper->getRecords();
                            if (empty($permissionsRecords)) {
                                throw new NullException("Error: No permissions stored on database!");
                            }

                            foreach($permissionsRecords as $permissionsRecord) {
                                $aclSetter->getAcl()->addResource($permissionsRecord['flag']);
                                $aclSetter->getAcl()->allow($records['roleName'], $permissionsRecord['flag']);
                            }

                        } else {
                            $wrapper = new UsersRolesPermissionsRelationsGetterWrapper(
                                new UsersRolesPermissionsRelationsGetter($entityManager)
                            );
                            $wrapper->setInput(array('roleId' => $records['roleId']));
                            $wrapper->setupQueryBuilder();

                            $permissionsRecords = $wrapper->getRecords();
                            if (empty($permissionsRecords)) {
                                throw new NullException("Error: No permissions stored on database!");
                            }

                            foreach($permissionsRecords as $permissionsRecord) {
                                $aclSetter->getAcl()->addResource($permissionsRecord['flag']);
                                $aclSetter->getAcl()->allow($records['roleName'], $permissionsRecord['flag']);
                            }
                        }

                        $sitename = $this->recoverSitename();

                        if (!$sitename) {
                            throw new NullException('Site name is not set. Cannot complete the login');
                        }

                        /* Set user session values */
                        $sessionContainer = new SessionContainer();
                        $sessionContainer->offsetSet('sitename', $sitename);
                        $sessionContainer->offsetSet('id',      $records['id']);
                        $sessionContainer->offsetSet('name',    $records['name']);
                        $sessionContainer->offsetSet('surname', $records['surname']);
                        $sessionContainer->offsetSet('email',   $records['email']);
                        $sessionContainer->offsetSet('acl',     $aclSetter->getAcl());
                        $sessionContainer->offsetSet('role',    $records['roleName']);

                        /* Regenerate Session ID after login */
                        $manager = new \Zend\Session\SessionManager;
                        $manager->regenerateId();

                    } else {
                        // throw new Exception('Cannot get user details after login');
                        $this->flashmessenger()->addMessage( print_r("Nome utente e\o password non validi", 1) );
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
