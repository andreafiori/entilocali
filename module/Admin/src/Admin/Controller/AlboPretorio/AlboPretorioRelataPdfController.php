<?php

namespace Admin\Controller\AlboPretorio;

use DOMPDFModule\View\Model\PdfModel;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;

class AlboPretorioRelataPdfController extends SetupAbstractController
{
    /**
     * @return PdfModel
     */
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        $helper = new AlboPretorioControllerHelper();
        $records = $helper->recoverWrapperRecordsById(
            new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );

        $pdf = new PdfModel();
        $pdf->setOption('filename',         'albo-pretorio-relata-atto-'.$records[0]['id']);
        $pdf->setOption('paperSize',        'a4');
        $pdf->setOption('paperOrientation', 'landscape');
        $pdf->setVariables( array('record' => $records[0]) );

        return $pdf;
    }
}
