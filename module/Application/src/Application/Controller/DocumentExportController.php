<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Controller for the creation of documents in alternate version\s
 * 
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class DocumentExportController extends AbstractActionController
{
    public function indexAction()
    {
        return new \Zend\View\Model\JsonModel( 
                array("id" => 1) 
        );
    }
}
