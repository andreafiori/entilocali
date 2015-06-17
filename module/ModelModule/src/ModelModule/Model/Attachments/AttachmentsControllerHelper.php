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
                'name'                      => $formData->attachmentFile['name'],
                'size'                      => $formData->attachmentFile['size'],
                'state'                     => null,
                'insert_date'               => date("Y-m-d H:i:s"),
                'atti_concessione_colonna'  => 1,
                'albo_rettificato'          => 0,
                'mime_id'                   => $mimeId,
                'user_id'                   => $userDetails->id,
            )
        );
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