<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Admin\Model\Utenti\UserFormAuthentication;

class AuthController extends AbstractActionController
{
    protected $form;
    protected $storage;
    protected $authservice;
    
    /**
     * @return \Zend\Authentication\AuthenticationService
     */
    public function getAuthService()
    {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }

        return $this->authservice;
    }
    
    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()->get('Admin\Model\MyAuthStorage');
        }
        
        return $this->storage;
    }
    
    public function getForm()
    {
        if (!$this->form) {
            $user       = new UserFormAuthentication();
            $builder    = new AnnotationBuilder();
            $this->form = $builder->createForm($user);
        }
        
        return $this->form;
    }
    
    public function loginAction()
    {
        // if already login, redirect to success page
        if ($this->getAuthService()->hasIdentity()){
            return $this->redirect()->toRoute('admin');
        }

        $form = $this->getForm();
        
        $this->layout()->setVariable('form', $form);
        $this->layout()->setVariable('messages', $this->flashmessenger()->getMessages());
        $this->layout('backend/templates/default/login.phtml');
        
        return array(
            'form'      => $form,
            'messages'  => $this->flashmessenger()->getMessages()
        );
    }
    
    public function authenticateAction()
    {
        $form       = $this->getForm();
        $redirect   = 'login';
        
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if ($form->isValid()) {
                //check authentication...
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));
                                       
                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                {
                    //save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }
                
                if ($result->isValid()) {
                    $redirect = 'admin';
                    //check if it has rememberMe:
                    if ($request->getPost('rememberme') == 1 ) {
                        $this->getSessionStorage()
                             ->setRememberMe(1);
                        //set storage again
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->setStorage($this->getSessionStorage());
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                    
                    // TODO: store user data on session, set login timeout, set ACL
                }
            } else {
                foreach($form->getMessages() as $message) {
                    $this->flashmessenger()->addMessage(print_r($message,1));
                }
            }
        }
        
        return $this->redirect()->toRoute($redirect, array("lang" => 'it'));
    }
    
    public function logoutAction()
    {
        if ($this->getAuthService()->hasIdentity()) {
            $this->getSessionStorage()->forgetMe();
            $this->getAuthService()->clearIdentity();
            $this->flashmessenger()->addMessage("Uscita dall'area di amministrazione");
        }
        
        return $this->redirect()->toRoute('login');
    }
}
