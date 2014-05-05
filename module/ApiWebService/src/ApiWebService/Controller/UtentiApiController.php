<?php

namespace ApiWebService\Controller;

use \Zend\Mvc\Controller\AbstractActionController;

/**
 * @author Andrea Fiori
 * @since  21 April 2014
 */
class UtentiApiController extends AbstractActionController
{
    /**
     * User list
     */
    public function indexAction()
    {
        
    }
    
    /**
     * Using email\username, return user data
     * 
     * @return \ApiWebService\Controller\JsonModel
     */
    public function loginAction()
    {
        
        
        return new JsonModel(
            array("id" => 1, "Nome" => "Andrea", "Cognome" => "Fiori")
        );
    }
}