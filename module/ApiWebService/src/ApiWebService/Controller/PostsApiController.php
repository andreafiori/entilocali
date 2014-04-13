<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Posts API Controller
 * 
 * @author Andrea Fiori
 * @since 10 April 2014
 */
class PostsApiController extends AbstractActionController
{
    public function indexAction()
    {
        return new JsonModel(
                array(
                        "status" => 200,
                        "data" => array(
                           array(
                               "titolo"      => "",
                               "descrizione" => "",
                           )
                        )
                )
        );
    }
}