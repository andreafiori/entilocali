<?php

namespace Application\Controller;

use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  25 February 2015
 */
class AttachmentsSThreeDownloaderController extends SetupAbstractController
{
    public function indexAction()
    {
        $type = $this->params()->fromRoute('type');
        $id = $this->params()->fromRoute('id');

        if (!isset($type) or !isset($id)) {
            return false;
        }

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
            return false;
        }

        $bucketDir = $type.'/';

        $filename = $attachmentRecord[0]['name'];
        $mimetype = $attachmentRecord[0]['mimetype'];

        $s3 = new S3($configurations['amazon_s3_accesskey'], $configurations['amazon_s3_secretkey']);
        $sthreeFile = $s3->getObject($configurations['amazon_s3_bucket'], $bucketDir.$filename);

        if ( empty($sthreeFile->body) ) {
            return false;
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