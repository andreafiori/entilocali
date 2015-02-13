<?php

namespace Feed\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Feed\Writer\Feed;
use Zend\View\Model\FeedModel;

/**
 * @author Andrea Fiori
 * @since  20 May 2013
 */
class FeedController extends AbstractActionController
{
    public function indexAction()
    {
        $moduleConfig = $this->getServiceLocator()->get('config');

        $feedClassMap = $moduleConfig['feed_class_map'];
    }
}
