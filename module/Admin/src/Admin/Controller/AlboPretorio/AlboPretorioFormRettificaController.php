<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliForm;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioFormControllerHelper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class AlboPretorioFormRettificaController extends SetupAbstractController
{
    public function indexAction()
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
            $articoloRecord[0]['checkRettifica'] = 1;

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