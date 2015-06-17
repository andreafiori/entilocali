<?php

namespace Application\Controller\AttiConcessione;

use Application\Controller\SetupAbstractController;
use DOMPDFModule\View\Model\PdfModel;
use ModelModule\Model\AttiConcessione\AttiConcessioneControllerHelper;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetterWrapper;

class AttiConcessioneExportSingleController extends SetupAbstractController
{
    /**
     * @return PdfModel|\Zend\Http\Response
     */
    public function pdfAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new AttiConcessioneControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $wrapper->setEntityManager($em);
        $records = $wrapper->addAttachmentsFromRecords($wrapper->getRecords(), array());

        if (empty($records)) {
            return $this->redirectForUnvalidAccess();
        }

        $pdf = new PdfModel();
        $pdf->setOption('filename',         Slugifier::slugify($records[0]['titolo']));
        $pdf->setOption('paperSize',        'a4');
        $pdf->setOption('paperOrientation', 'landscape');
        $pdf->setVariables(array(
            'record'    => !(empty($records)) ? $records[0] : null,
            'sitename'  => $this->layout()->getVariable('sitename'),
        ));
        $pdf->setTemplate('common/export/atti-concessione/atti-concessione-single-pdf.phtml');

        return $pdf;
    }

    public function csvAction()
    {

    }

    public function txtAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new AttiConcessioneControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $wrapper->setEntityManager($em);
        $records = $wrapper->addAttachmentsFromRecords($wrapper->getRecords(), array());

        if (empty($records)) {
            return $this->redirectForUnvalidAccess();
        }

        $content = '';
        $content .= $this->layout()->getVariable('sitename').PHP_EOL;
        $content .= PHP_EOL;
        $content .= "Albo pretorio".PHP_EOL;
        $content .= PHP_EOL;

        foreach($records as $record) {
            $content .= $record['titolo'].PHP_EOL;
            $content .= 'Numero \ Anno: '.$record['numeroAtto'].' \ '.$record['anno'].PHP_EOL;
            $content .= 'Sezione: '.$record['nomeSezione'].PHP_EOL;
            $content .= "Scadenza: ".$record['dataScadenza']->format("d-m-Y").PHP_EOL;
        }
        $content .= " ".PHP_EOL;
        $content .= date("Y").' '.$this->layout()->getVariable('sitename');

        $response = $this->getResponse();
        $response->getHeaders()
            ->addHeaderLine('Content-Type', 'text/plain')
            ->addHeaderLine('Content-Disposition', 'attachment; filename="'.Slugifier::slugify($record['titolo']).'.txt"')
            ->addHeaderLine('Accept-Ranges', 'bytes')
            ->addHeaderLine('Content-Length', strlen($content) );

        $response->setContent($content);

        return $response;
    }

    /**
     * @return JsonModel|\Zend\Http\Response
     */
    public function jsonAction()
    {
        $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        $helper = new AlboPretorioControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $wrapper->setEntityManager($em);

        $records = $wrapper->addAttachmentsFromRecords($wrapper->getRecords(), array());

        if (empty($records)) {
            return $this->redirectForUnvalidAccess();
        }
        $record = $records[0];

        return new JsonModel(array(
            'Titolo'        => $record['titolo'],
            'Numero \ Anno' => $record['numeroAtto'].' \ '.$record['anno'],
            'Scadenza'      => $record['dataScadenza']->format("d-m-Y"),
            'Sezione'       => $record['nomeSezione'],
        ));
    }
}