<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Response;

/**
 * Main RESTful API Web Service Controller
 * 
 * @author Andrea Fiori
 * @since  03 April 2014
 */
class DefaultApiController extends AbstractActionController
{
    public function indexAction()
    {
        return new JsonModel(array(
            'status' => 200,
            'data'   => array('message' => 'Welcome to the main REST API web service'),
        ));
    }

    public function invalidAction()
    {
    	$response = new Response();
    	$response->setStatusCode(Response::STATUS_CODE_403);
    	$response->setContent( json_encode( array("status" => $response->getStatusCode(), "message"=>'Error 403') ) );
        
    	return $response;
    }
}