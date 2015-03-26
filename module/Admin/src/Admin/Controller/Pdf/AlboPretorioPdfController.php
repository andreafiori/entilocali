<?php

namespace Admin\Controller\Pdf;

use Application\Controller\SetupAbstractController;
use DOMPDFModule\View\Model\PdfModel;
use Zend\View\Model\ViewModel;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  22 December 2014
 */
class AlboPretorioPdfController extends SetupAbstractController
{
    /**
     * @return PdfModel
     */
    public function relataAction()
    {
        $this->checkLogin();

        $pdf = new PdfModel();
        $pdf->setOption('filename', 'albo-pretorio-relata');
        $pdf->setOption('paperSize', 'a4');
        $pdf->setOption('paperOrientation', 'landscape');

        $id = $this->params()->fromRoute('id');
        $records = $this->getArticle($id);

        $pdf->setVariables(array(
            'record' => $records[0]
        ));

        return $pdf;
    }
    
    /**
     * @param int $id
     * @return AlboPretorioArticoliGetterWrapper
     */
    private function getArticle($id)
    {
        $wrapper = new AlboPretorioArticoliGetterWrapper(
            new AlboPretorioArticoliGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'))
        );
        $wrapper->setInput(
            array(
                'id' => $id,
                'limit' => 1
            )
        );
        $wrapper->setupQueryBuilder();
        
        return $wrapper->getRecords();
    }
}