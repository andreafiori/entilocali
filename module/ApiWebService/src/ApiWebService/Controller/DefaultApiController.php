<?php

namespace ApiWebService\Controller;

use Zend\Http\Request;
use Zend\Http\Response;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;

/**
 * Main API Controller
 * TODO: 
 *      Check method:
 *          GET /tickets/12 - Retrieves list of messages for ticket #12
            GET /tickets/12 - Retrieves message #5 for ticket #12
            POST /tickets/12 - Creates a new message in ticket #12
            PUT /tickets/12 - Updates message #5 for ticket #12
            PATCH /tickets/12 - Partially updates message #5 for ticket #12
            DELETE /tickets/12 - Deletes message #5 for ticket #12
 *      Check authentication login with API key via GET or user\password via POST
 *      Check ID if passed
 * 
 * @author Andrea Fiori
 * @since 10 April 2014
 */
class DefaultApiController extends AbstractActionController
{
    /**
     * @return \Zend\View\Model\JsonModel
     */
    public function indexAction()
    {
        $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $httpMethod = $this->getRequest()->getMethod();

        switch($httpMethod) {
            case("GET"):
                
            break;
        
            case("POST"):
                
            break;
        }
        
        $resource = $this->params()->fromRoute('resource');
        if (!$resource) {
            $response = new Response();
            $response->setStatusCode(Response::STATUS_CODE_403);
            $response->setContent( json_encode(
                    array(
                        "status" => $response->getStatusCode(), 
                        "message" => 'API resource not set'
                    ) 
                ) 
            );
            return $response;
        }
        /*
         * Bad OR NO Authentication error
        if (!isset($noAuthentication)) {
            $response = new Response();
            $response->setStatusCode(Response::STATUS_CODE_401);
            $response->setContent( json_encode(
                    array(
                        "status" => $response->getStatusCode(), 
                        "message" => 'Unauthorized: bad authentication'
                    ) 
                )
            );
            return $response;
        }
        */
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($entityManager) );
        $postsGetterWrapper->setInput( array() );
        $postsGetterWrapper->setupQueryBuilder();
        
        return new JsonModel( array_filter(
                array(
                    'method' => $httpMethod,
                    'page'  => '',
                    'perpage' => '',
                    'data' => $postsGetterWrapper->getRecords()
                )
            )
        );
    }
    
    /*
    public function authenticationAction()
    {
        
    }
    
        private function setupAuthenticationInput(array $input)
        {
            
        }
        
    
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
    	$response->setContent( json_encode( array("status" => $response->getStatusCode(), "message" => 'Error 403') ) );
        
    	return $response;
    } 
    */
}
