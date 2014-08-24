<?php

namespace ApiWebService\Model\Resources;

use ApiWebService\Model\ApiSetupAbstract;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class PostsApiResource extends ApiSetupAbstract
{
    private $entityManager;
    
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @param array $input
     * @return array
     */
    public function getResourceRecords(array $input)
    {
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->entityManager) );
        $postsGetterWrapper->setInput($input);
        $postsGetterWrapper->setupQueryBuilder();
        
        return $postsGetterWrapper->getRecords();
    }
}
