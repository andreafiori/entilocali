<?php

namespace Language\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Language\Model\Language;

class LanguageController extends AbstractActionController
{
    public function indexAction()
    {
        return array( new ViewModel() );
    }
}
