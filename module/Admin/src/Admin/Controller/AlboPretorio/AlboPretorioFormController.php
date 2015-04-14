<?php

namespace Admin\Controller\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioArticoliForm;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Admin\Model\AlboPretorio\AlboPretorioFormControllerHelper;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  06 April 2015
 */
class AlboPretorioFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id             = $this->params()->fromRoute('id');
        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $helper         = new AlboPretorioFormControllerHelper();

        try {
            $sezioniRecords = $helper->recoverSezioniRecords( new AlboPretorioSezioniGetterWrapper(
                    new AlboPretorioSezioniGetter($em)
                )
            );

            $helper->checkSezioniIsNotEmpty($sezioniRecords);

            $records = $helper->recoverAlboArticolo(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                isset($id) ? $id : null
            );

            $helper->checkArticoloIsNotAnnull($records);

            $form = new AlboPretorioArticoliForm();
            $form->addSezioni( $helper->formatSezioniForADropdown($sezioniRecords) );
            $form->addTitolo();
            $form->addMainFields();
            $form->addScadenze();
            // Add users checkbox: $userRecords = $helper->recoverUsersRecords(new UsersGetterWrapper(new UsersGetter($em)));

            if ( !empty($records) ) {

                $form->setData($records[0]);

                $formAction     = 'albo-pretorio/update/'.$records[0]['id'];
                $formTitle      = $records[0]['titolo'];

            } else {
                $form->addFacebook();

                $formAction = 'albo-pretorio/insert/';
                $formTitle  = 'Nuovo atto';
            }

            $this->layout()->setVariables(array(
                    'form'                          => $form,
                    'formAction'                    => $formAction,
                    'formTitle'                     => $formTitle,
                    'formDescription'               => "Compila i dati relativi all'atto da inserire sull'albo pretorio",
                    'templatePartial'               => self::formTemplate,
                    'formBreadCrumbCategory'        => 'Albo pretorio',
                    'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/albo-pretorio-summary', array('lang' => 'it')),
                )
            );

        } catch(NullException $e) {
            $message = $e->getParams();

            $this->layout()->setVariables(array(
                'messageType'     => $message['type'],
                'messageTitle'    => $message['title'],
                'messageText'     => $message['text'],
                'templatePartial' => 'message.phtml',
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}