<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Render the RSS feed of a data resource
 * 
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class FeedController extends AbstractActionController
{
    public function indexAction()
    {
        return new \Zend\View\Model\JsonModel(
                array()
                );
    }
}

