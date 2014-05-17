<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractRestfulController;
use Application\Model\Posts\PostsGetter;
use Application\Model\Posts\PostsGetterWrapper;

/**
 * Posts API Controller
 * 
 * @author Andrea Fiori
 * @since 10 April 2014
 */
class PostsApiController extends AbstractRestfulController
{
    public function getList()
    {
        // Check authentication login
        /*
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity()) {
            return new JsonModel(
                array("error"=>'Not authorized')
            );
        }
        */
        
        
        $serviceLocator = $this->getServiceLocator();
        $serviceManager = $serviceLocator->get('servicemanager');
        $entityManager  = $serviceLocator->get('Doctrine\ORM\EntityManager');
        
        $posts = new PostsGetterWrapper( new PostsGetter($entityManager) );
        return new JsonModel(
                array("id"=>1)
        );
    }
    
    /**
     * 
     * @param type $id
     */
    public function get($id)
    {
        
    }
    
    public function create($data)
    {
        
    }
    
    public function delete($id)
    {
        
    }
}