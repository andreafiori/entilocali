<?php

namespace Application\Controller;

use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use DOMPDFModule\View\Model\PdfModel;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class DocumentExportController extends AbstractActionController
{
    private $subjectMap = array(
        'albo-pretorio' => 'Admin\Model\AlboPretorio\AlboPretorioDocumentExporter'
    );

    public function indexAction()
    {
        $subject    = $this->params()->fromRoute('subject');
        $filetype   = $this->params()->fromRoute('filetype');
        $id         = $this->params()->fromRoute('id');

        switch($subject) {
            case("contenuti"):
                $wrapper = new ContenutiGetterWrapper(new ContenutiGetter(
                    $this->getServiceLocator()
                         ->get('doctrine.entitymanager.orm_default')
                ));
                $wrapper->setInput(array(
                    'id' => $id
                ));
                $wrapper->setupQueryBuilder();
                $records = $wrapper->getRecords();

                if (empty($records)) {
                    $response = new Response();
                    $response->setContent('Contenuto non disponibile');
                    return $response;
                }

                switch($filetype) {
                    case("pdf"):
                        $pdf = new PdfModel();
                        $pdf->setOption('filename', $records[0]['slug']);
                        $pdf->setOption('paperSize', 'a4');
                        $pdf->setOption('paperOrientation', 'landscape');

                        $pdf->setVariables(array(
                            'record' => $records[0]
                        ));

                        $pdf->setTemplate('common/export/pdf/contenuti.phtml');

                        return $pdf;

                    case("txt"):

                    break;
                }

            break;
        }

        return new \Zend\View\Model\JsonModel(
                array("id" => $id)
        );
    }
}
