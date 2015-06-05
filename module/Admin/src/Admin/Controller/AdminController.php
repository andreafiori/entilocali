<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Users\Todo\UsersTodoForm;
use Zend\View\Model\ViewModel;
use ModelModule\Model\SetupAbstractControllerHelper;
use ModelModule\Model\RouterManagers\RouterManager;
use ModelModule\Model\RouterManagers\RouterManagerHelper;
use Zend\Session\Container as SessionContainer;

class AdminController extends SetupAbstractController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();

        $lasUpdatePasswordDate1 = new \DateTime(date('Y-m-d', strtotime($userDetails->passwordLastUpdate->date)));
        $lasUpdatePasswordDate2 = new \DateTime(date('Y-m-d', strtotime(date("Y-m-d H:i:s"))));
        $lastUpdatePasswordDays = $lasUpdatePasswordDate1->diff($lasUpdatePasswordDate2)->days;

        $this->layout()->setVariables(array(
            'form' => new UsersTodoForm(),
            'showPasswordNotSecureWarning'  => (!empty($userDetails->salt)) ? 0 : 1,
            'showUpdatePasswordWarning'     => ($lastUpdatePasswordDays > 30) ? 1 : 0,
            'templatePartial'               => 'dashboard/dashboard.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}