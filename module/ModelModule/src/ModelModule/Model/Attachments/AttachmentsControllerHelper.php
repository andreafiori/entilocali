<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * Attachments helper with database operations
 */
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
                'title'                     => $formData->title,
                'description'               => $formData->description,
                'name'                      => $formData->attachmentFile['name'],
                'size'                      => $formData->attachmentFile['size'],
                'status'                    => null,
                'insert_date'               => date("Y-m-d H:i:s"),
                'expire_date'               => $formData->expireDate,
                'position'                  => 0,
                'atti_concessione_colonna'  => 0,
                'atti_concessione_category' => 0,
                'albo_rettificato'          => 0,
                'albo_id'                   => 0,
                'language_id'               => 1,
                'mime_id'                   => $mimeId,
                'user_id'                   => $userDetails->id,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Insert attachment relation into db
     *
     * @param InputFilterAwareInterface $formData
     * @param int $lastInsertId
     * @return int
     */
    public function insertAttachmentsRelations(InputFilterAwareInterface $formData, $lastInsertId)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::attachmentsRelations,
            array(
                'attachment_id' => $lastInsertId,
                'reference_id' => $formData->referenceId,
                'module_id' => $formData->moduleId,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update attachment file name
     *
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
     * Update position number
     *
     * @param int $attachmentId
     * @return int
     */
    public function updatePosition($attachmentId, $position)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::attachments,
            array('position' => $position),
            array('id' => $attachmentId)
        );
    }

    /**
     * Delete attachment record from db
     *
     * @param int $id
     * @return int
     */
    public function deleteAttachments($id)
    {
        $this->assertConnection();

        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
        $this->getConnection()->delete(
            DbTableContainer::attachments,
            array('id' => $id),
            array('limit' => 1)
        );
        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');

        return true;
    }

    /**
     * Delete attachment relation from db
     *
     * @param int $attachmentId
     *
     * @return int
     */
    public function deleteAttachmentsRelations($attachmentId)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::attachmentsRelations,
            array('attachment_id' => $attachmentId),
            array('limit' => 1)
        );
    }
}