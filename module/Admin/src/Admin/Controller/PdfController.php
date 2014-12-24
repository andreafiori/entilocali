<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use DOMPDFModule\View\Model\PdfModel;

class PdfController extends SetupAbstractController
{
    public function generatepdfAction()
    {
        $pdf = new PdfModel();
        $pdf->setOption('filename', 'monthly-report');
        $pdf->setOption('paperSize', 'a4');
        $pdf->setOption('paperOrientation', 'landscape');

        $pdf->setVariables(array(
          'name' => 'Andrea'
        ));
        
        return $pdf;
    }
}