<?php

namespace Application\Controller\AlboPretorio;

use DOMPDFModule\View\Model\PdfModel;
use Zend\View\Model\JsonModel;
use Application\Controller\SetupAbstractController;

/**
 * Albo Pretorio export multiple atti in different formats
 */
class AlboPretorioExportController extends SetupAbstractController
{
    /**
     * @return PdfModel|\Zend\Http\Response
     */
    public function pdfAction()
    {

    }

    public function txtAction()
    {

    }
}