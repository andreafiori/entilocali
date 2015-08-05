<?php

namespace ModelModule\Model\StatoCivile;

use ModelModule\Model\Amazon\S3\S3Helper;
use ModelModule\Model\Database\Redbean\RedbeanHelperAbstract;
use ModelModule\Model\Modules\ModulesContainer;

class StatoCivileMigrator extends RedbeanHelperAbstract
{
    const tempDir = 'stato-civile/';

    /**
     * @return bool
     */
    public function deleteAllTempFile()
    {
        return $this->deleteAllDirTempFile(self::tempDir);
    }

    /**
     * @return array
     */
    public function recoverAllegati()
    {
        return $this->getRecords("SELECT statallegat.id, id_statocivile, statallegat.nome FROM statocivile_allegati statallegat, mimetype WHERE (id_mime = mimetype.id) ");
    }

    /**
     * @param int $id
     * @return array
     */
    public function recoverSingleAllegati($id)
    {
        return $this->getRecords("SELECT statallegat.id, nome, dati, mimetype FROM statocivile_allegati statallegat, mimetype WHERE (id_mime = mimetype.id) AND statallegat.id = '".$id."' ");
    }

    /**
     * Extract attachments files and save them on file system
     *
     * @param array $attachmentRecords
     *
     * @return bool
     */
    public function migrateAttachments($attachmentRecords)
    {
        if (empty($attachmentRecords) or !is_array($attachmentRecords)) {
            return false;
        }

        $s3Helper = new S3Helper();

        // $this->truncateAttachmentsTables();
        // $this->deleteAllTempFile();

        foreach($attachmentRecords as $attachment) {

            $newAttachmentFilename = $s3Helper->assignFileName($attachment['nome'], $attachment['id']);

            $insertAttach = $this->insertAttachment($newAttachmentFilename, $attachment);
            $this->checkRedBeanQueryResult($insertAttach);

            $lastID = $this->recoverLastInsertId();

            $this->checkRedBeanQueryResult(
                $this->insertAttachmentRelation($lastID, $attachment['id_statocivile'], ModulesContainer::stato_civile_id)
            );

            $singleAttachment = $this->recoverSingleAllegati($attachment['id']);

            $this->saveFileToFileSystem(self::tempDir, $newAttachmentFilename, $singleAttachment[0]['dati']);
        }

        return true;
    }
}