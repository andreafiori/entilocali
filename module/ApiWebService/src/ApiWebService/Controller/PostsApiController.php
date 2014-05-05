<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\Posts\PostsGetter;
use Application\Model\Posts\PostsGetterWrapper;

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
     *      pagination
     *      XML format \ strategy
     *      Append attachments records
     */
    public function indexAction()
    {
        $input = array(
            "channel"           => $this->params()->fromQuery('channel'),
            "language"          => $this->params()->fromQuery('language'),
            "id"                => $this->params()->fromQuery('id'),
            "nome_categoria"    => $this->params()->fromQuery('nome_categoria'),
            "titolo"            => $this->params()->fromQuery('titolo'),
            "tipo"              => $this->params()->fromQuery('tipo'),
            "formato"           => $this->params()->fromQuery('formato'),
        );
        $doctrineEntityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($doctrineEntityManager) );
        $postsGetterWrapper->setInput($input);
        $posts = $postsGetterWrapper->getRecords();
        
        if (!$posts) {
            // TODO: set error , not found
            exit;
        }
        
        if ($this->params()->fromQuery('formato') === 'xml') {
            
        } else {
            return new JsonModel(
                    array(
                        "status" => 200,
                        "data" => $posts,
                        "template" => $posts[0]['template']
                    )
            );
        }
    }
           
}
