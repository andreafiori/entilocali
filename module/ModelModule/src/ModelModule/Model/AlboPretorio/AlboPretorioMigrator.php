<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\Amazon\S3\S3Helper;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Database\Redbean\RedbeanHelperAbstract;

class AlboPretorioMigrator extends RedbeanHelperAbstract
{
    const tempDir = 'albo-pretorio/';

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
        return $this->getRecords("SELECT albo_allegati.id, id_albo, albo_allegati.nome FROM albo_allegati, mimetype WHERE (id_mime = mimetype.id) ");
    }

    /**
     * @param int $id
     * @return array
     */
    public function recoverSingleAllegati($id)
    {
        return $this->getRecords("SELECT albo_allegati.id, nome, dati, mimetype FROM albo_allegati, mimetype WHERE (id_mime = mimetype.id) AND albo_allegati.id = '".$id."' ");
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
                $this->insertAttachmentRelation($lastID, $attachment['id_albo'], ModulesContainer::albo_pretorio_id)
            );

            $singleAttachment = $this->recoverSingleAllegati($attachment['id']);

            $this->saveFileToFileSystem(self::tempDir, $newAttachmentFilename, $singleAttachment[0]['dati']);
        }

        return true;
    }

    /**
     * Delete all new albo pretorio atti
     */
    public function trucateAlboPretorioAtti()
    {
        $this->executeQuery("SET foreign_key_checks = 0 ");
        $this->executeQuery("TRUNCATE TABLE ".DbTableContainer::alboArticoli." ");
        $this->executeQuery("SET foreign_key_checks = 1 ");
    }
}
