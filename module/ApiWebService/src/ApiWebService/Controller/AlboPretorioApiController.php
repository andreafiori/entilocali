<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
//use Zend\Http\Response;

class AlboPretorioApiController extends AbstractActionController
{
    /**
     * Get Albo Pretorio list
     * 
     * @return array
     */
    public function indexAction()
    {
        //$this->getResponse()->getHeaders()->addHeaders(array('Content-type' => 'text/xml'));
        return new JsonModel(
                array(
                        "status" => 200,
                        "data" => array(
                               array("" => ""),
                        ),
                        "page" => 1,
                )			
        );
    }
}