<?php

namespace ApiWebService\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\NullException;
use ApiWebService\Model\ApiSetup;
use ApiWebService\Model\ApiOutputManager;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * TODO: allow method\s for every single resource of the classMap
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
        $outputFormat   = $this->params()->fromRoute('output_format');
        
        $apiSetup = new ApiSetup();
        
        $apiOutputManager = new ApiOutputManager($outputFormat);
        
        try {

            $apiSetup->setMethod($method);
            $apiSetup->setInput( $this->detectInput($method) );
            $apiSetup->setEntityManager($entityManager);
            // setup API Key here...
            $apiSetup->setResourceClassMap($moduleConfig['resources_class_map']);
            $apiSetup->setResourceClassName( $this->params()->fromRoute('resource') );
            // validate input: tipo di richiesta, risorsa e formato richiesto va visto se vanno bene
            // set error and status code for the final response...

        } catch (NullException $ex) {
            $apiOutputManager->setStatusCode(401);
            return $apiOutputManager->setupOutput( array(
                'message'   => $ex->getMessage()
                )
            );
        }

        $input      = $apiSetup->getInput();
        $className  = $apiSetup->getResourceClassName();
        
        $classInstance = new $className($entityManager);
        $classInstance->setPage( isset($input['page']) ? $input['page'] : null );
        $classInstance->setPerPage( isset($input['perpage']) ? $input['perpage'] : null );
        
        $resourceRecords = $classInstance->getResourceRecords($input);
        if (!$resourceRecords) {
            $apiOutputManager->setStatusCode(401);
            return $apiOutputManager->setupOutput( array(
                    'message' => 'No records found for this recource'
                )
            );
        }

        return $apiOutputManager->setupOutput($resourceRecords);
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
