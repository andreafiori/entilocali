<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliForm;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
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
        $lang           = $this->params()->fromRoute('lang');

        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new AlboPretorioControllerHelper();
        try {
            $sezioniRecords = $helper->recoverWrapperRecords(
                new AlboPretorioSezioniGetterWrapper( new AlboPretorioSezioniGetter($em) ),
                array(
                    'fields' => 'aps.id, aps.nome',
                    'orderBy' => 'aps.nome ASC',
                )
            );
            $helper->checkRecords($sezioniRecords, 'Sezioni non presenti o non rilevate dal sistema. Verificare i dati delle sezioni o inserirne una nuova');
            $articoliRecords = $helper->recoverWrapperRecordsById(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                array('id' => $id, 'limit' => 1),
                $id
            );
            $helper->checkArticoloIsNotAnnulled($articoliRecords);

            $numeroProgressivo = $helper->recoverNumeroProgressivo(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em))
            );

            $form = new AlboPretorioArticoliForm();
            $form->addSezioni($helper->formatForDropwdown($sezioniRecords, 'id', 'nome'));
            $form->addTitolo();
            $form->addNumero();
            $form->addAnno();
            $form->addMainFields();
            $form->addScadenze();
            $form->addHomePage();

            if ( !empty($articoliRecords) ) {

                $form->setData($articoliRecords[0]);

                $formAction     = $this->url()->fromRoute('admin/albo-pretorio-update', array(
                    'lang' => $lang
                ));
                $formTitle      = $articoliRecords[0]['titolo'];
                $submitButtonValue = 'Modifica';

            } else {
                $form->addFacebook();
                $form->setData(array(
                    'anno'       => date("Y"),
                    'numeroAtto' => $numeroProgressivo,
                ));

                $formAction = $this->url()->fromRoute('admin/albo-pretorio-insert', array(
                    'lang' => $lang
                ));
                $formTitle  = 'Nuovo atto';
                $submitButtonValue = 'Inserisci';
            }

            $this->layout()->setVariables(array(
                'form'                          => $form,
                'formAction'                    => $formAction,
                'formTitle'                     => $formTitle,
                'formDescription'               => "Compila i dati relativi all'atto da inserire sull'albo pretorio",
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbCategory'        => array(
                    array(
                        'label' => 'Albo pretorio',
                        'href'  => $this->url()->fromRoute('admin/albo-pretorio-summary', array(
                            'lang' => $lang
                        )),
                        'title' => "'Torna all'elenco atti albo pretorio",
                    )
                ),
                'templatePartial'               => self::formTemplate,
            ));

        } catch(NullException $e) {
            $message = $e->getParams();

            $this->layout()->setVariables(array(
                'messageType'               => $message['type'] ? $message['type'] : 'warning',
                'messageTitle'              => $message['title'] ? $message['title'] : 'Problema verificato',
                'messageText'               => $message['text'] ? $message['text'] : $e->getMessage(),
                'showBreadCrumb'            => 1,
                'formBreadCrumbCategory'    => 'Albo pretorio',
                'templatePartial'           => 'message.phtml',
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}