<?php

namespace Admin\Controller\Users\RespProc;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Users\RespProc\UsersRespProcForm;
use ModelModule\Model\Users\RespProc\UsersRespProcGetter;
use ModelModule\Model\Users\RespProc\UsersRespProcGetterWrapper;
use ModelModule\Model\Users\UsersControllerHelper;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;

/**
 * Responsabili procedimento atti di concessione management
 */
class UsersRespProcController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new UsersControllerHelper();
        $userRecords = $helper->recoverWrapperRecords(
            new UsersGetterWrapper(new UsersGetter($em)),
            array(
                'fields'      => 'u.id, u.name, u.surname',
                'adminAccess' => 1,
                'orderBy'     => 'u.surname'
            )
        );
        $usersForDropDown = $helper->formatForDropwdown(
            $userRecords,
            'id',
            'name'
        );

        $usersRespProcRecords = $helper->recoverWrapperRecords(
            new UsersRespProcGetterWrapper(new UsersRespProcGetter($em)),
            array('orderBy' => '')
        );

        $form = new UsersRespProcForm();
        $form->addUsers($usersForDropDown);

        $this->layout()->setVariables(array(
            'form'                   => $form,
            'usersRespProc'          => $usersRespProcRecords,
            'formDataCommonPath'     => 'backend/templates/common/',
            'formBreadCrumbCategory' => array(
                array(
                    'href'  => $this->url()->fromRoute('admin/users-resp-proc-management', array(
                        'lang' => $this->params()->fromRoute('lang')
                    )),
                    'label' => 'Atti di concessione',
                    'title' => 'Elenco atti di concessione',
                ),
            ),
            'formBreadCrumbTitle'    => 'Responsabili procedimento',
            'templatePartial'        => 'users/resp-proc-management.phtml'
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}
