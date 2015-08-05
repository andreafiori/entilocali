<?php

namespace Application\Controller;

use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;

/**
 * Attachments AWS S3 Frontend Download file Controller
 */
class AttachmentsSThreeDownloaderController extends SetupAbstractController
{
    public function indexAction()
    {
        $type = $this->params()->fromRoute('type');
        $id = $this->params()->fromRoute('id');

        $appServiceLoader = $this->recoverAppServiceLoader();
        $configurations = $appServiceLoader->recoverService('configurations');

        $wrapper = new AttachmentsGetterWrapper(new AttachmentsGetter(
            $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')
        ));
        $wrapper->setInput(array(
            'id'    => $id,
            'limit' => 1,
        ));
        $wrapper->setupQueryBuilder();
        $attachmentRecord = $wrapper->getRecords();

        if ( empty($attachmentRecord) ) {
            return $this->redirect()->toRoute('notfound', array('lang' => 'it'));
        }

        $bucketDir = $type.'/';

        $filename = $attachmentRecord[0]['name'];
        $mimetype = $attachmentRecord[0]['mimetype'];

        $s3 = new S3($configurations['amazon_s3_accesskey'], $configurations['amazon_s3_secretkey']);
        $sthreeFile = $s3->getObject($configurations['amazon_s3_bucket'], $bucketDir.$filename);

        if ( empty($sthreeFile->body) ) {
            return $this->redirect()->toRoute('notfound', array('lang' => 'it'));
        }

        $response = $this->getResponse();
        $response->setContent($sthreeFile->body);
        $response
                ->getHeaders()
                ->addHeaderLine('Content-Type', 'public')
                ->addHeaderLine('Content-Description', 'File Transfer')
                ->addHeaderLine('Content-Disposition', 'attachment; filename='.$filename)
                ->addHeaderLine('Content-Type', $mimetype);

        return $response;
    }
}