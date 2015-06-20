<?php

namespace Application\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use DOMPDFModule\View\Model\PdfModel;
use ModelModule\Model\Slugifier;
use Zend\View\Model\JsonModel;
use Application\Controller\SetupAbstractController;

class ContenutiExportSingleController extends SetupAbstractController
{
    public function pdfAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new ContenutiControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new ContenutiGetterWrapper(new ContenutiGetter($em)),
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
        $pdf->setTemplate('common/export/contenuti/contenuti-single-pdf.phtml');

        return $pdf;
    }

    public function txtAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new ContenutiControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new ContenutiGetterWrapper(new ContenutiGetter($em)),
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
        $content .= "Articolo".PHP_EOL;
        $content .= PHP_EOL;

        foreach($records as $record) {
            $content .= $record['titolo'].PHP_EOL;
            if ($record['sommario']!='') {
                $content .= strip_tags($record['sommario']).PHP_EOL;
            }
            $content .= strip_tags($record['testo']).PHP_EOL;
            $content .= 'Sezione: '.$record['nomeSezione'].PHP_EOL;
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

    public function jsonAction()
    {
        $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        $helper = new ContenutiControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new ContenutiGetterWrapper(new ContenutiGetter($em)),
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
            'Testo'         => $record['testo'],
            'Sezione'       => $record['nomeSezione'],
        ));
    }
}