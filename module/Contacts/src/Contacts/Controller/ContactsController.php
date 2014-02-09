<?php

namespace Contacts\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ContactsController extends AbstractActionController
{
    public function indexAction()
    {
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		var_dump( $this->params()->fromPost() );
    	}
    	//var_dump( $this->params()->fromFiles() );
    	
    	$response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent("Hello World");
        return $response;
    }
}
