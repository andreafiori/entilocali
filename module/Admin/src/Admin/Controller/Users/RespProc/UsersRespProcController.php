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
 * Users responsabili procedimento
 */
class UsersRespProcController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {

            $helper = new UsersControllerHelper();
            $usersRespProcRecords = $helper->recoverWrapperRecords(
                new UsersRespProcGetterWrapper(new UsersRespProcGetter($em)),
                array('orderBy' => 'u.surname')
            );
            $idsToExclude = $helper->gatherIdsFromRecordset($usersRespProcRecords);

            $userRecords = $helper->recoverWrapperRecords(
                new UsersGetterWrapper(new UsersGetter($em)),
                array(
                    'fields'      => 'u.id, u.name, u.surname',
                    'adminAccess' => 1,
                    'excludeId'   => $idsToExclude,
                    'orderBy'     => 'u.surname'
                )
            );

            if (!empty($userRecords)) {
                $usersForDropDown = $helper->formatForDropwdown(
                    $userRecords,
                    'id',
                    'name'
                );
            } else {
                $usersForDropDown = array();
            }

            $form = new UsersRespProcForm();
            $form->addUsers($usersForDropDown);

            $this->layout()->setVariables(array(
                'form'                   => $form,
                'usersRespProc'          => $usersRespProcRecords,
                'usersForDropDown'       => $usersForDropDown,
                'formDataCommonPath'     => 'backend/templates/common/',
                'formBreadCrumbCategory' => array(
                    array(
                        'href' => $this->url()->fromRoute('admin/users-responsabili-procedimento', array(
                            'lang' => $this->params()->fromRoute('lang')
                        )),
                        'label' => 'Atti di concessione',
                        'title' => 'Elenco atti di concessione',
                    ),
                ),
                'formBreadCrumbTitle'    => 'Responsabili procedimento',
                'templatePartial'        => 'users/resp-proc-management.phtml'
            ));

        } catch(\Exception $e) {

        }

        $this->layout()->setTemplate($mainLayout);
    }
}
