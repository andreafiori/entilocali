<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliForm;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioFormControllerHelper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\NullException;

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
            $helper->setupAlboArticolo(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                isset($id) ? $id : null
            );

            $articoliRecords = $helper->getAlboArticolo();

            $helper->checkArticoloIsNotAnnull($articoliRecords);

            $form = new AlboPretorioArticoliForm();
            $form->addSezioni($helper->formatSezioniForADropdown($sezioniRecords));
            $form->addTitolo();
            $form->addNumero();
            $form->addAnno();
            $form->addMainFields();
            $form->addScadenze();

            // Add users checkbox: $userRecords = $helper->recoverUsersRecords(new UsersGetterWrapper(new UsersGetter($em)));

            if ( !empty($articoliRecords) ) {

                $form->setData($articoliRecords[0]);

                $formAction     = 'albo-pretorio/update/'.$articoliRecords[0]['id'];

                $formTitle      = $articoliRecords[0]['titolo'];

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