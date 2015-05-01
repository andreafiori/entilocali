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

    public function rettificaAction()
    {
        if ($this->getServiceLocator()->get('request')->isPost()) {
            $mainLayout = $this->initializeAdminArea();

            $id = $this->params()->fromPost('revisionId');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $helper = new AlboPretorioFormControllerHelper();
            $helper->setupAlboArticolo(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                isset($id) ? $id : null
            );
            $helper->checkArticoloIsNotAnnull($helper->getAlboArticolo());

            $sezioniRecords = $helper->recoverSezioniRecords(
                new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($em))
            );
            $articoloRecord = $helper->getAlboArticolo();

            $form = new AlboPretorioArticoliForm();
            $form->addNote();
            $form->addSezioni( $helper->formatSezioniForADropdown($sezioniRecords) );
            $form->addTitolo();
            $form->addMainFields();
            $form->addScadenze();
            $form->setData($articoloRecord[0]);

            $this->layout()->setVariables(array(
                    'form'                          => $form,
                    'formAction'                    => 'albo-pretorio/update/'.$articoloRecord[0]['id'],
                    'formTitle'                     => $articoloRecord[0]['titolo'],
                    'formDescription'               => "Compila i dati relativi all'atto da inserire sull'albo pretorio",
                    'templatePartial'               => self::formTemplate,
                    'formBreadCrumbCategory'        => 'Albo pretorio',
                    'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/albo-pretorio-summary', array('lang' => 'it')),
                    'alboRevisionWarning'           => 1,
                    'alboNumeroAtto'                => $articoloRecord[0]['numeroAtto'],
                    'alboAnnoAtto'                  => $articoloRecord[0]['anno'],
                )
            );

            $this->layout()->setTemplate($mainLayout);

            return true;
        }

        return $this->redirect()->toRoute('admin/albo-pretorio-summary', array('lang' => 'it'));
    }
}