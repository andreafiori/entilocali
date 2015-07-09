<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use ModelModule\DashboardControllerHelper;
use ModelModule\Model\Contacts\ContactsGetter;
use ModelModule\Model\Contacts\ContactsGetterWrapper;
use ModelModule\Model\Log\LogGetter;
use ModelModule\Model\Log\LogGetterWrapper;
use ModelModule\Model\Tickets\TicketsGetter;
use ModelModule\Model\Tickets\TicketsGetterWrapper;
use ModelModule\Model\Users\Todo\UsersTodoForm;
use ModelModule\Model\Users\Todo\UsersTodoGetter;
use ModelModule\Model\Users\Todo\UsersTodoGetterWrapper;
use Zend\View\Model\ViewModel;

class AdminController extends SetupAbstractController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $userDetails = $this->recoverUserDetails();

        $helper = new DashboardControllerHelper();
        $lastUpdatePasswordDays = $helper->calculateLastUpdatePasswordDays($userDetails->passwordLastUpdate->date);
        $logRecords = $helper->recoverWrapperRecords(
            new LogGetterWrapper(new LogGetter($em)),
            array(
                'userId'    => $userDetails->id,
                'orderBy'   => 'l.datetime DESC',
                'limit'     => 10,
            )
        );
        $contactMessages = $helper->recoverWrapperRecords(
            new ContactsGetterWrapper(new ContactsGetter($em)),
            array('fields' => 'COUNT(c.id) AS msgCount ')
        );
        $todoRecords = $helper->recoverWrapperRecords(
            new UsersTodoGetterWrapper(new UsersTodoGetter($em)),
            array('userId' => $userDetails->id)
        );
        $ticketList = $helper->recoverWrapperRecords(
            new TicketsGetterWrapper(new TicketsGetter($em)),
            array(
                'userId'    => $userDetails->id,
                'orderBy'   => 't.createDate DESC',
                'limit'     => 10,
            )
        );

        $this->layout()->setVariables(array(
            'form'                          => new UsersTodoForm(),
            'showPasswordNotSecureWarning'  => (!empty($userDetails->salt)) ? 0 : 1,
            'showUpdatePasswordWarning'     => ($lastUpdatePasswordDays > 30) ? 1 : 0,
            'logRecords'                    => $logRecords,
            'contactFormMsg'                => $contactMessages,
            'todoListCount'                 => count($todoRecords),
            'todoList'                      => $todoRecords,
            'ticketList'                    => $ticketList,
            'ticketCount'                   => count($ticketList),
            'templatePartial'               => 'dashboard/dashboard.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * NOT Authorized page
     */
    public function notauthorizedAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setVariables(array(
            'templatePartial' => 'not-authorized.phtml',
        ));

        /* Set not authorized HTTP status code */
        $this->getResponse()->setStatusCode(401);

        $this->layout()->setTemplate($mainLayout);
    }
}