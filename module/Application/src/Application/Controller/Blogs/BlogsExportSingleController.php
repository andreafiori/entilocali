<?php

namespace Application\Controller\Blogs;

use Application\Controller\SetupAbstractController;
use DOMPDFModule\View\Model\PdfModel;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ModelModule\Model\Slugifier;
use Zend\View\Model\JsonModel;

class BlogsExportSingleController extends SetupAbstractController
{
    public function pdfAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new PostsControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new PostsGetterWrapper(new PostsGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $wrapper->setEntityManager($em);
        $records = $wrapper->addAttachmentsFromRecords($wrapper->getRecords(), array());

        if (empty($records)) {
            return $this->redirectForUnvalidAccess();
        }

        $pdf = new PdfModel();
        $pdf->setOption('filename',         Slugifier::slugify($records[0]['title']));
        $pdf->setOption('paperSize',        'a4');
        $pdf->setOption('paperOrientation', 'landscape');
        $pdf->setVariables(array(
            'record'    => !(empty($records)) ? $records[0] : null,
            'sitename'  => $this->layout()->getVariable('sitename'),
        ));
        $pdf->setTemplate('common/export/blogs/blogs-single-pdf.phtml');

        return $pdf;
    }

    public function txtAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new PostsControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new PostsGetterWrapper(new PostsGetter($em)),
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
            $content .= $record['title'].PHP_EOL;
            $content .= PHP_EOL;
            $content .= strip_tags($record['description']).PHP_EOL;
        }
        $content .= " ".PHP_EOL;
        $content .= date("Y").' '.$this->layout()->getVariable('sitename');

        $response = $this->getResponse();
        $response->getHeaders()
                ->addHeaderLine('Content-Type', 'text/plain')
                ->addHeaderLine('Content-Disposition', 'attachment; filename="'.Slugifier::slugify($record['title']).'.txt"')
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

        $helper = new PostsControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new PostsGetterWrapper(new PostsGetter($em)),
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
            'Titolo'        => $record['title'],
            'Sottotitolo'   => $record['subtitle'],
            'Descrizione'   => $record['description'],
            /* 'Categorie'     => $record['categories'], */
        ));
    }
}