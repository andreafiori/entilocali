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
     * Insert attachment file into db
     *
     * @param InputFilterAwareInterface $formData
     * @param int $mimeId
     * @return int
     */
    public function insertAttachments(InputFilterAwareInterface $formData, $mimeId)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        $this->getConnection()->insert(
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

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Insert attachment options into db
     *
     * @param InputFilterAwareInterface $formData
     * @param $lastInsertId
     */
    public function insertAttachmentsOptions(InputFilterAwareInterface $formData, $lastInsertId)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::attachmentsOption,
            array(
                'title' => $formData->title,
                'description'   => $formData->description,
                'expire_date'   => date("Y-m-d H:i:s"),
                'attachment_id' => $lastInsertId,
                'language_id'   => 1,
            )
        );
    }

    /**
     * Insert attachment relation into db
     *
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
                'title'         => $formData->title,
                'description'   => $formData->description,
                'expire_date'   => $formData->expireDate,
            ),
            array('id' => $formData->attachmenOptionId),
            array('limit' => 1)
        );
    }

    /**
     * Update atti concessione colonna display value
     *
     * @param int $id
     * @param int $attiConcessioneColonna
     *
     * @return int
     */
    public function updateAttiConcessioneColonna($id, $attiConcessioneColonna)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::attachments,
            array(
                'atti_concessione_colonna' => $attiConcessioneColonna
            ),
            array('id' => $id),
            array('limit' => 1)
        );
    }

    /**
     * Delete attachment record from db
     *
     * @param int $id
     * @return int
     */
    public function deteteAttachments($id)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::attachments,
            array('id' => $id),
            array('limit' => 1)
        );
    }

    /**
     * Delete attachment options from db
     *
     * @param int $attachmentOptionId
     *
     * @return int
     */
    public function deteteAttachmentsOptions($attachmentOptionId)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::attachmentsOption,
            array('id' => $attachmentOptionId),
            array('limit' => 1)
        );
    }

    /**
     * Delete attachment relation from db
     *
     * @param int $attachmentId
     * @param int $referenceId
     * @param int $moduleId
     *
     * @return int
     */
    public function deteteAttachmentsRelations($attachmentId, $referenceId, $moduleId)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::attachmentsRelations,
            array(
                'attachment_id' => $attachmentId,
                'reference_id'  => $referenceId,
                'module_id'     => $moduleId,
            ),
            array('limit' => 1)
        );
    }
}