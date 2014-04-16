<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Posts API Controller
 * 
 * @author Andrea Fiori
 * @since 10 April 2014
 */
class PostsApiController extends AbstractActionController
{
    /**
     * TODO:
     *      pagination for big lists
     *      XML format
     *      Remove queries from the controller
     *      Append attachments records
     *      Centralize code on models and test it!
     * 
     * @return \Zend\View\Model\JsonModel posts list
     */
    public function indexAction()
    {
        $postsGetter = new \ApiWebService\Model\PostsGetter( ServiceLocatorFactory::getInstance()->get('\Doctrine\ORM\EntityManager') );
        $postsGetter->setMainQuery();
        $postsGetter->setChannelId( $this->params()->fromQuery('channel') );
        $postsGetter->setLanguageId( $this->params()->fromQuery('language') );
        $postsGetter->setId( $this->params()->fromQuery('id') );
        $postsGetter->setNomeCategoria( $this->params()->fromQuery('category') );
        $postsGetter->setTitolo( $this->params()->fromQuery('title') );
        $postsGetter->setTipo( $this->params()->fromQuery('tipo') );
        // TODO: get sorted posts with $this->params()->fromQuery('sort');
        $posts = $postsGetter->getQueryResult();
        
        if (!$posts) {
            // TODO: set error xxx, records not found. In this case, guzzle must catch the error
        }
        
        if ($this->params()->fromQuery('format') === 'xml') {
            // TODO: XML strategy to generalize
        } else {
            return new JsonModel(
                    array(
                        "status" => 200,
                        "data" => $posts,
                        "template" => ''
                    )
            );           
        }
    }
}
