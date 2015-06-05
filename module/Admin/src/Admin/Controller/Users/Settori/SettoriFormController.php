<?php

namespace Admin\Controller\Users\Settori;

use ModelModule\Model\Users\Settori\UsersSettoriForm;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Users\UsersControllerHelper;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;

class SettoriFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');

        $helper = new UsersControllerHelper();
        $settoriRecords = $helper->recoverWrapperRecordsById(
            new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $usersRecords = $helper->recoverWrapperRecords(
            new UsersGetterWrapper(new UsersGetter($em)),
            array('adminAccess' => 1)
        );

        $toReturn = array();
        foreach($usersRecords as $record) {
            if (isset($record['id']) and isset($record['surname']) and isset($record['name'])) {
                $toReturn[$record['id']] = $record['surname'].' '.$record['name'];
            }
        }

        $usersRecordsForDropDown = $toReturn;

        $form = new UsersSettoriForm();
        $form->addResponsabile($usersRecordsForDropDown);

        if ($settoriRecords) {
            $form->setData($settoriRecords[0]);

            $submitButtonValue = 'Modifica';
            $formTitle         = 'Modifica settore utente';
            $formAction        = $this->url()->fromRoute('admin/users-settori-update', array('lang' => $lang));
        } else {
            $formTitle          = 'Nuovo settore utente';
            $submitButtonValue  = 'Inserisci';
            $formAction         = $this->url()->fromRoute('admin/users-settori-insert', array('lang' => $lang));
        }

        $this->layout()->setVariables( array(
                'formTitle'              => $formTitle,
                'formDescription'        => 'Compila i dati relativi al settore utenti',
                'form'                   => $form,
                'formAction'             => $formAction,
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => array(
                    array(
                        'label' => 'Utenti',
                        'href'  => $this->url()->fromRoute('admin/users-summary', array('lang' => $lang)),
                        'title' => 'Elenco utenti'
                    ),
                    array(
                        'label' => 'Settori',
                        'href'  => $this->url()->fromRoute('admin/users-settori-summary', array('lang' => $lang)),
                        'title' => 'Elenco settori utenti'
                    ),
                ),
                'noFormActionPrefix'         => 1,
                'templatePartial'            => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}