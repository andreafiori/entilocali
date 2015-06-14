<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliForm;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class AlboPretorioFormRettificaController extends SetupAbstractController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('request')->isPost()) {

            $mainLayout = $this->initializeAdminArea();

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $lang = $this->params()->fromRoute('lang');
            $id = $this->params()->fromPost('revisionId');

            try {

                $helper = new AlboPretorioControllerHelper();
                $articoloRecord = $helper->recoverWrapperRecordsById(
                    new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                    array('id' => $id, 'limit' => 1),
                    $id
                );
                $helper->checkRecords($articoloRecord, 'Atto albo pretorio non trovato');
                $sezioniRecords = $helper->recoverWrapperRecords(
                    new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($em)),
                    array()
                );

                $articoloRecord[0]['checkRettifica'] = 1;

                $form = new AlboPretorioArticoliForm();
                $form->addNote();
                $form->addSezioni( $helper->formatForDropwdown($sezioniRecords, 'id', 'nome') );
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
                        'formBreadCrumbCategory'        => array(
                            array(
                                'label' => 'Albo pretorio',
                                'href'  => $this->url()->fromRoute('admin/albo-pretorio-summary', array(
                                    'lang' => $lang
                                )),
                                'title' => "'Torna all'elenco atti albo pretorio",
                            )
                        ),
                        'alboRevisionWarning'           => 1,
                        'alboNumeroAtto'                => $articoloRecord[0]['numeroAtto'],
                        'alboAnnoAtto'                  => $articoloRecord[0]['anno'],
                    )
                );

                $this->layout()->setTemplate($mainLayout);

            } catch(\Exception $e) {
                $this->layout()->setVariables(array(
                        'messageType'       => 'warning',
                        'messageTitle'      => 'Errore verificato',
                        'messageText'       => $e->getMessage(),
                        'showBreadCrumb'        => 1,
                        'formBreadCrumbCategory' => array(
                            array(
                                'label' => 'Albo pretorio',
                                'href' => $this->url()->fromRoute('admin/albo-pretorio-operations', array(
                                    'lang'          => $this->params()->fromRoute('lang'),
                                    'action'        => 'publish'
                                )),
                                'title' => "Vai all'elenco atti albo pretorio",
                            ),
                        ),
                        'dataTableActiveTitle'  => 'Rettifica atto',
                        'templatePartial'       => 'message.phtml'
                    )
                );
            }
        } else {
            return $this->redirect()->toRoute('admin/albo-pretorio-summary', array('lang' => $this->params()->fromRoute('lang')));
        }
    }
}