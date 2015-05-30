<?php

namespace Auth\Controller;

use ModelModule\Model\SetupAbstractControllerHelper;
use Zend\View\Model\ViewModel;
use Zend\Session\Container as SessionContainer;
use Zend\Permissions\Acl\Acl;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Users\UserFormAuthentication;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
use ModelModule\Model\Users\AclSetter;
use ModelModule\Model\Users\Roles\UsersRolesGetter;
use ModelModule\Model\Users\Roles\UsersRolesGetterWrapper;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsGetter;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsGetterWrapper;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsRelationsGetter;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsRelationsGetterWrapper;
use ModelModule\Model\NullException;
use \Exception;

class AuthController extends SetupAbstractController
{
    private $authservice;

    private $sessionStorage;
    
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        $templateBackend = $appServiceLoader->recoverServiceKey('configurations', 'template_backend');

        /* Preview Password Area Check */
        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            return $this->redirect()->toRoute('password-preview');
        }

        $request = $this->getRequest();

        $helper = new SetupAbstractControllerHelper();
        $helper->setConfigurations($configurations);
        $helper->setRequest($request);
        $helper->setupZf2appDir();
        $helper->setupAppDirRelativePath();

        $this->layout()->setVariables($configurations);
        $this->layout()->setVariables(
            array(
                'publicDirRelativePath' => $helper->getAppDirRelativePath().'/public',
                'form'                  => new UserFormAuthentication(),
                'messages'              => $this->flashMessenger()->getMessages(),
            )
        );

        return $this->layout('backend/templates/'.$templateBackend.'login.phtml');
    }

    /**
     * @return Redirect
     * @throws Exception
     */
    public function authenticateAction()
    {
        $form       = new UserFormAuthentication();
        $redirect   = 'login';
        $request    = $this->getRequest();
        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // check authentication...
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));

                $result = $this->getAuthService()->authenticate();

                foreach($result->getMessages() as $message) {
                    $this->flashmessenger()->addMessage($message);
                }

                if ($result->isValid()) {
                    $redirect = 'admin';

                    // set session timeout stored in MyAuthStorage class...
                    $this->getSessionStorage()
                         ->setRememberMe();

                    // set storage into the auth service
                    $this->getAuthService()->setStorage($this->getSessionStorage());
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                    
                    // Search user into db
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

                        // Set ACL
                        $aclSetter = new AclSetter(new Acl());
                        $aclSetter->setUsersRolesGetterWrapper(new UsersRolesGetterWrapper(
                                new UsersRolesGetter($entityManager)
                            )
                        );
                        $aclSetter->addRoles($aclSetter->recoverRoles(array()));

                        if ($records['roleName'] === 'WebMaster') {

                            // Assign all permissions
                            $wrapper = new UsersRolesPermissionsGetterWrapper(
                                new UsersRolesPermissionsGetter($entityManager)
                            );
                            $wrapper->setInput(array());
                            $wrapper->setupQueryBuilder();

                            $permissionsRecords = $wrapper->getRecords();
                            if (empty($permissionsRecords)) {
                                throw new NullException("Error: no permissions stored on database!");
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
                                throw new NullException("Error: no permissions stored on database!");
                            }

                            foreach($permissionsRecords as $permissionsRecord) {
                                $aclSetter->getAcl()->addResource($permissionsRecord['flag']);
                                $aclSetter->getAcl()->allow($records['roleName'], $permissionsRecord['flag']);
                            }
                        }

                        $sitename = $configurations['sitename'];

                        if (!$sitename) {
                            throw new NullException('Site name is not set. Cannot complete the login');
                        }

                        $userDetails = new \stdClass();
                        $userDetails->sitename              = $sitename;
                        $userDetails->id                    = $records['id'];
                        $userDetails->name                  = $records['name'];
                        $userDetails->surname               = $records['surname'];
                        $userDetails->email                 = $records['email'];
                        $userDetails->acl                   = $aclSetter->getAcl();
                        $userDetails->salt                  = $records['salt'];
                        $userDetails->passwordLastUpdate    = $records['passwordLastUpdate'];
                        $userDetails->role                  = $records['roleName'];

                        // Set user session values
                        $sessionContainer = new SessionContainer();
                        $sessionContainer->offsetSet('userDetails', $userDetails);

                        /* Regenerate Session ID after login */
                        $manager = new \Zend\Session\SessionManager;
                        $manager->regenerateId();

                    } else {
                        $this->flashmessenger()->addMessage( print_r("Nome utente e\o password non validi", 1) );
                    }
                }
            } else {

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
     * @param \Zend\Authentication\AuthenticationService $authservice
     */
    public function setAuthService(\Zend\Authentication\AuthenticationService $authservice)
    {
        $this->authservice = $authservice;
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

        session_destroy();

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
         * @return \ModelModule\Model\MyAuthStorage
         */
        private function getSessionStorage()
        {
            if (!$this->sessionStorage) {
                $this->sessionStorage = $this->getServiceLocator()->get('MyAuthStorage');
            }

            return $this->sessionStorage;
        }
}
