<?php

namespace ApiWebService\Controller;

use Zend\Http\Response;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\NullException;
use ApiWebService\Model\ApiInputSetterGetter;
use ApiWebService\Model\ApiAuthenticator;
use ApiWebService\Model\ApiResourceHandler;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * Main API Controller
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
        $method = $this->getRequest()->getMethod();
        
        $apiSetup = new ApiInputSetterGetter();
        try {
            
            $apiSetup->setMethod($method);
            $apiSetup->setInput( $this->getInputBasedOnMethod($method) );
            $apiSetup->setupAuthenticationInput();
            
            $apiAuthenticator = new ApiAuthenticator($entityManager);
            $apiAuthenticator->setUsersGetterWrapper( new UsersGetterWrapper(new UsersGetter($entityManager)) );
            $apiAuthenticator->authenticate($apiSetup->getAuthenticationInput());
            
        } catch (NullException $ex) {
            return $apiSetup->getResponseToReturn();
        }
        
        $apiResourceHandler = new ApiResourceHandler();
        try {
            $apiResourceHandler->setResourceClassName( $this->params()->fromRoute('resource') );
            $className = $apiResourceHandler->getResourceClassName();
            $classInstance = new $className($entityManager);
            $data = $classInstance->getResourceRecords(array());
            
        } catch (NullException $ex) {
            return $apiResourceHandler->getResponseToReturn();
        }
        
        return new JsonModel( array_filter(
                array(
                    'method' => $method,
                    'page'  => 1,
                    'perpage' => '',
                    'data' => $data,
                )
            )
        );
    }
    
        /**
         * @param string $method
         * @return array
         */
        private function getInputBasedOnMethod($method)
        {
            if ($method == 'GET') {
                return (array) $this->params()->fromQuery();
            } elseif ($method == 'POST') {
                return (array) $this->params()->fromPost();
            } else {
                parse_str(file_get_contents("php://input"), $input);
                
                return $input;
            }
        }
}
