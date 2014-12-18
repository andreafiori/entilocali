<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use DOMPDFModule\View\Model\PdfModel;

class PdfController extends SetupAbstractController
{
    public function generatepdfAction()
    {
        $pdf = new PdfModel();
        $pdf->setOption('filename', 'monthly-report'); // Triggers PDF download, automatically appends ".pdf"
        $pdf->setOption('paperSize', 'a4'); // Defaults to "8x11"
        $pdf->setOption('paperOrientation', 'landscape'); // Defaults to "portrait"

        $pdf->setVariables(array(
          'message' => 'Hello'
        ));
        $pdf->setTemplate('prova.phtml');
        return $pdf;
    }
}