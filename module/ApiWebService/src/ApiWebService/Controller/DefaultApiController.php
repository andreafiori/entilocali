<?php

namespace ApiWebService\Controller;

use Zend\Http\Response;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\NullException;
use ApiWebService\Model\ApiSetup;
use ApiWebService\Model\ApiResourceHandler;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * Main API Controller
 * TODO: differ class method or response per method request (GET,POST,PUT,DELETE) $method
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
        $method         = $this->getRequest()->getMethod();
        $moduleConfig   = $serviceLocator->get('config');
        
        $apiSetup = new ApiSetup();
        try {
            
            $apiSetup->setMethod($method);
            $apiSetup->setInput( $this->detectInput($method) );
            $apiSetup->setupAuthenticationInput();
            $apiSetup->setEntityManager($entityManager);
            $apiSetup->setUsersGetterWrapper( new UsersGetterWrapper(new UsersGetter($entityManager) ) );
            $apiSetup->authenticate();
            $apiSetup->setResourceClassMap($moduleConfig['resources_class_map']);
            $apiSetup->setResourceClassName( $this->params()->fromRoute('resource') );
            
        } catch (NullException $ex) {
            return $apiSetup->getResponseToReturn();
        }

        $input      = $apiSetup->getInput();
        $className  = $apiSetup->getResourceClassName();
        $classInstance = new $className($entityManager);
        $classInstance->setPage( isset($input['page']) ? $input['page'] : null );
        $classInstance->setPerPage( isset($input['perpage']) ? $input['perpage'] : null );
        $resourceRecords = $classInstance->getResourceRecords($input);
        
        if (!$resourceRecords) {
            $response = new Response();
            $response->setStatusCode(Response::STATUS_CODE_401);
            $response->setContent( json_encode( array_filter( array(
                        'status'    => $response->getStatusCode(),
                        'method'    => $method,
                        'message'   => 'No records found for this recource.'
                        )
                    )
                )
            );
            return $response;
        }
        
        return new JsonModel( array_filter(
                /*
                array(
                    'method'    => $method,
                    'totalItemCount' => '', // $paginatorRecords->getTotalItemCount(),
                    'page'      => $classInstance->getPage(),
                    'perpage'   => $classInstance->getPerpage(),
                    'data'      => $resourceRecords,
                )
                */
                $resourceRecords
            )
        );
    }
    
        /**
         * @param string $method
         * @return array
         */
        private function detectInput($method)
        {
            if ($method == 'GET') {
                return (array) $this->params()->fromQuery();
            } elseif ($method == 'POST') {
                return (array) $this->params()->fromPost();
            } else {
                $input = '';
                parse_str(file_get_contents("php://input"), $input);
                return $input;
            }
        }
}
