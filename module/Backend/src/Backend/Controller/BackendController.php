<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 *
 */
class BackendController extends AbstractActionController
{
    public function indexAction()
    {
    	/*
    	$adapter = new \Zend\Db\Adapter\Adapter( array(
    			'driver'   => 'Mysqli',
    			'database' => 'fossobandito',
    			'username' => 'root',
    			'password' => ''
    	));
    	
    	$isconnected = $adapter->getDriver()->getConnection()->isConnected();
    	if($isconnected){
    		$message = 'connected';
    	} else {
    		$message = 'not Valid data field';
    	}
    	echo $message;
    	*/
        $this->layout()->setTemplate('backend/backend/index');
    }
}
