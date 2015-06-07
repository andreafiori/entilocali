<?php

namespace ApiWebService\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ModelModule\Model\NullException;
use ApiWebService\Model\ApiSetup;
use ApiWebService\Model\ApiOutputManager;
use Zend\View\Model\JsonModel;

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

        $input = $apiSetup->getInput();

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

            /*
            $recordsGetter = new AlboPretorioRecordsGetter(array());
            $recordsGetter->setEntityManager($entityManager);
            $recordsGetter->setArticoliInput(array());
            $recordsGetter->setArticoliPaginator();
            $recordsGetter->setArticoliPaginatorCurrentPage(isset($input['page']) ? $input['page'] : null);
            $recordsGetter->setArticoliPaginatorPerPage(isset($input['perpage']) ? $input['perpage'] : null);

            $paginator = $recordsGetter->getPaginatorRecords();
            */

            $toReturn = array();
            foreach($paginator as $row) {
                $toReturn[] = array_filter($row);
            }

            return new JsonModel($toReturn);

        } catch (NullException $ex) {
            $apiOutputManager->setStatusCode(401);
            return $apiOutputManager->setupOutput( array(
                    'message'   => $ex->getMessage()
                )
            );
        }


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
