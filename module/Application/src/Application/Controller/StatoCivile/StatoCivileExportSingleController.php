<?php

namespace Application\Controller\StatoCivile;

use ModelModule\Model\Slugifier;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use DOMPDFModule\View\Model\PdfModel;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Export\CsvExportHelper;
use Zend\View\Model\JsonModel;

/**
 * Stato civile search and export after a search POST request
 */
class StatoCivileExportSingleController extends SetupAbstractController
{
    /**
     * Export single atto in CSV format
     *
     * @return \Zend\Http\Response|\Zend\Stdlib\ResponseInterface
     */
    public function csvAction()
    {
        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new StatoCivileControllerHelper();
        $records = $helper->recoverWrapperRecordsById(
            new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );

        if ( !empty($records) ) {

            $arrayContent = array();
            $arrayContent[] = array('Titolo', 'Numero \ Anno', 'Inserito il', 'Scadenza');
            foreach($records as $record) {
                $arrayContent[] = array(
                    $record['titolo'],
                    $record['progressivo'].' / '.$record['anno'],
                    $record['data']->format("d-m-Y"),
                    $record['scadenza']->format("d-m-Y"),
                );
            }

            $csvExportHelper = new CsvExportHelper();

            $content = $csvExportHelper->makeCsvLine($arrayContent);

            $response = $this->getResponse();
            $response->getHeaders()
                ->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine('Content-Disposition', 'attachment; filename="'.Slugifier::slugify($record['titolo']).'.csv"')
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($content) );
            $response->setContent($content);

            return $response;
        }
    }

    /**
     * Search and export in PDF format
     *
     * @return PdfModel|\Zend\Http\Response
     * @throws \ModelModule\Model\NullException
     */
    public function pdfAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new StatoCivileControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $wrapper->setEntityManager($em);
        $records = $wrapper->addAttachmentsFromRecords($wrapper->getRecords(), array());

        if (empty($records)) {
            return $this->redirectForUnvalidAccess();
        }

        $pdf = new PdfModel();
        $pdf->setOption('filename', Slugifier::slugify($records[0]['titolo']));
        $pdf->setOption('paperSize',        'a4');
        $pdf->setOption('paperOrientation', 'landscape');
        $pdf->setVariables( array(
                'record'    => !(empty($records)) ? $records[0] : null,
                'sitename'  => $this->layout()->getVariable('sitename'),
            )
        );
        $pdf->setTemplate('common/export/stato-civile/stato-civile-single-pdf.phtml');

        return $pdf;
    }

    /**
     * @return \Zend\Http\Response|\Zend\Stdlib\ResponseInterface
     */
    public function txtAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new StatoCivileControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
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
        $content .= "Stato civile".PHP_EOL;
        $content .= PHP_EOL;

        foreach($records as $record) {
            $content .= $record['titolo'].PHP_EOL;
            $content .= 'Sezione: '.$record['nomeSezione'].PHP_EOL;
            $content .= "Inserito il: ".$record['data']->format("d-m-Y").PHP_EOL;
            $content .= "Scadenza: ".$record['scadenza']->format("d-m-Y").PHP_EOL;
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
     * @return \Zend\Http\Response|JsonModel
     */
    public function jsonAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new StatoCivileControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
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
            'Numero \ Anno' => $record['progressivo'].' \ '.$record['anno'],
            'Scadenza'      => $record['scadenza']->format("d-m-Y"),
            'Sezione'       => $record['nomeSezione'],
        ));
    }
}
