<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;

class AttachmentsControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @param int $mimeId
     * @return int
     */
    public function insertAttachments(InputFilterAwareInterface $formData, $mimeId)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        return $this->getConnection()->insert(
            DbTableContainer::attachments,
            array(
                'name' => $formData->attachmentFile['name'],
                'size' => $formData->attachmentFile['size'],
                'state' => null,
                'insert_date' => date("Y-m-d H:i:s"),
                'mime_id' => $mimeId,
                'user_id' => $userDetails->id,

            )
        );

        /*
        // $configurations = $this->getConfigurationsFromDb();

        $attachmentsTableLastInsertId = $this->getConnection()->lastInsertId();

        // Insert attachment options
        $lastId = $this->getConnection()->lastInsertId();

        $this->getConnection()->insert($this->tableName_options, array(
            'title'         => $formData->title,
            'description'   => $formData->description,
            'expire_date'   => date("Y-m-d H:i:s"),
            'attachment_id' => $this->getConnection()->lastInsertId(),
            'language_id'   => 1,
        ));

        $this->getConnection()->update($this->tableName, array(
            'name' => AttachmentsContainer::assignFileName($formData->attachmentFile['name'], $lastId)
        ),
            array('id' => $lastId)
        );

        // Upload on Amazon S3
        $filename = AttachmentsContainer::assignFileName($formData->attachmentFile['name'], $lastId);
        $s3 = new S3(
            $configurations['amazon_s3_accesskey'],
            $configurations['amazon_s3_secretkey']
        );
        $s3Upload = $s3->putObject(
            S3::inputFile($formData->attachmentFile['tmp_name'], false),
            $configurations['amazon_s3_bucket'],
            $formData->s3_directory.'/'.$filename,
            S3::ACL_PUBLIC_READ
        );

        if (!$s3Upload) {
            throw new NullException("Errore upload file ".$configurations['amazon_s3_bucket'].' - ');
        }

        // Insert Relations
        return $this->getConnection()->insert(
            DbTableContainer::attachmentsRelations,
            array(
                'attachment_id' => $lastInsertId,
                'reference_id'  => $formData->referenceId,
                'module_id'     => $formData->moduleId,
            )
        );
        */
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @param $lastInsertId
     * @throws \ModelModule\Model\NullException
     */
    public function insertAttachmentsOptions(InputFilterAwareInterface $formData, $lastInsertId)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::attachmentsOption,
            array(
                'title' => $formData->title,
                'description' => $formData->description,
                'expire_date' => date("Y-m-d H:i:s"),
                'attachment_id' => $lastInsertId,
                'language_id' => 1,
            )
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @param $lastInsertId
     * @return int
     */
    public function insertAttachmentsRelations(InputFilterAwareInterface $formData, $lastInsertId)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::attachmentsRelations,
            array(
                'attachment_id' => $lastInsertId,
                'reference_id' => $formData->referenceId,
                'module_id' => $formData->moduleId,
            )
        );
    }

    /**
     * @param int $id
     * @param string $filename
     * @return int
     * @throws NullException
     */
    public function updateAttachmentsFilename($id, $filename)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::attachments,
            array('name' => $filename),
            array('id' => $id),
            array('limit' => 1)
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function updateOptions(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::attachmentsOption,
            array(
                'title' => $formData->title,
                'description' => $formData->description,
                'expire_date' => $formData->expireDate,
            ),
            array('id' => $formData->attachmenOptionId),
            array('limit' => 1)
        );
    }

    public function deteteAttachments($id)
    {
        $this->assertConnection();

    }

    public function deteteAttachmentsOptions($id)
    {
        $this->assertConnection();

    }

    public function deteteAttachmentsRelations($id)
    {
        $this->assertConnection();

    }
}