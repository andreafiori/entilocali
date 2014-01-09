<?php

namespace Contacts\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WorkWithUs extends AbstractActionController
{
	public function indexAction()
	{
		echo "workwithus";
		return new ViewModel();
	}
}