<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractRestfulController;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;

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
        // TODO: Check authentication login
        
        
        $serviceLocator = $this->getServiceLocator();
        $serviceManager = $serviceLocator->get('servicemanager');
        $entityManager  = $serviceLocator->get('Doctrine\ORM\EntityManager');
        
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($entityManager) );
        $postsGetterWrapper->setInput( array() );
        $postsGetterWrapper->setupQueryBuilder();
        
        return new JsonModel( $postsGetterWrapper->getRecords() );
    }
    
    /**
     * Return posts details by ID
     * 
     * @param number $id
     */
    public function get($id)
    {
        if ( !is_numeric($id) ) {
            return new JsonModel(
                    array(
                        'error' => 403,
                        'message' => 'Invalid argument: ID must be a number'
                    )
            );
        }
        
        $serviceLocator = $this->getServiceLocator();
        $serviceManager = $serviceLocator->get('servicemanager');
        $entityManager  = $serviceLocator->get('Doctrine\ORM\EntityManager');
        
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($entityManager) );
        $postsGetterWrapper->setInput( array('id'=>1) );
        $postsGetterWrapper->setupQueryBuilder();
        
        return new JsonModel( $postsGetterWrapper->getRecords() );
    }
    
    /**
     * @param type $data
     */
    public function create($data)
    {
        
    }
    
    public function delete($id)
    {
        
    }
}