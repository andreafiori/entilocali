<?php

namespace Admin\Model\Contenuti;

use Admin\Model\Migrazione\MigratorAbstract;
use Admin\Model\Amazon\S3\S3;
use Application\Model\Slugifier;

class ContenutiAllegatiMigrator extends MigratorAbstract
{
    /**
     * Import Attachment files to S3
     */
    public function migrate()
    {
        $this->assertRedbeanHelper();

        $appConfigurationsFromDb = $this->getInput('configurations',1);
        $attachmentRecords = $this->getRedbeanHelper()->getRecord("SELECT contenuti_allegati.id, contenuti_allegati.id_contenuti, nome FROM contenuti_allegati, mimetype WHERE (id_mime = mimetype.id) ");

        $this->getRedbeanHelper()->executeQuery("TRUNCATE TABLE zfcms_attachments ");
        $this->getRedbeanHelper()->executeQuery("TRUNCATE TABLE zfcms_attachments_options ");
        $this->getRedbeanHelper()->executeQuery("TRUNCATE TABLE zfcms_attachments_relations ");

        foreach($attachmentRecords as $attachment) {

            $newAttachmentFilename = str_replace(" ", "-", trim(strtolower($attachment['nome'])) );
            $newAttachmentFilename = str_replace("'", "", $newAttachmentFilename);
            $newAttachmentFilename = str_replace("+", "-", $newAttachmentFilename);
            $newAttachmentFilename = str_replace("à", "a", $newAttachmentFilename);
            $newAttachmentFilename = $attachment['id'].'_'.$newAttachmentFilename;

            $insertAttach = $this->getRedbeanHelper()->executeQuery("INSERT INTO zfcms_attachments
(name, size, state, insert_date, mime_id, user_id) (SELECT '$newAttachmentFilename', size, 'active', NOW(), id_mime, 1 FROM contenuti_allegati WHERE id = '".$attachment['id']."' ) ");

            $lastID = $this->getRedbeanHelper()->getRecord("SELECT last_insert_id() AS last_insert_id ");

            $this->getRedbeanHelper()->executeQuery("INSERT INTO zfcms_attachments_options
(title, description, attachment_id) VALUES ('".$newAttachmentFilename."', '', '".$lastID[0]['last_insert_id']."') ");

            $this->getRedbeanHelper()->executeQuery("INSERT INTO zfcms_attachments_relations (attachment_id, reference_id, module_id) VALUES ('".$lastID[0]['last_insert_id']."', ".$attachment['id_contenuti'].", '2' ) ");

            $this->getRedbeanHelper()->getRecord("SELECT contenuti_allegati.id, nome, contenuti_allegati.dati, mimetype FROM contenuti_allegati, mimetype WHERE (id_mime = mimetype.id) AND contenuti_allegati.id = '".$attachment['id']."' ");

            /* Upload to S3
            $s3 = new S3($appConfigurationsFromDb['amazon_s3_accesskey'], $appConfigurationsFromDb['amazon_s3_secretkey']);
            $s3->putObject(
                $singleAttachment[0]['dati'],
                $appConfigurationsFromDb['amazon_s3_bucket'],
                'contenuti/'.$newAttachmentFilename,
                S3::ACL_PUBLIC_READ,
                array(),
                array('Content-Type' => $singleAttachment[0]['mimetype'])
            );
            */

            /* Save file on file system
            $fp = fopen('public/frontend/media/contenuti/'.$newAttachmentFilename, 'w');
            fwrite($fp, $singleAttachment[0]['dati']);
            fclose($fp);
            */
        }
    }

    public function log()
    {
        $this->assertLogWriter();

        $this->getLogWriter()->writeLog(array(
            'user_id'   => $this->getUserDetailsKey('id'),
            'module_id' => 2,
            'message'   => $this->getUserDetailsKey('name').' '.$this->getUserDetailsKey('surname')." ha effettuato la <strong>migrazione contenuti</strong> dal database vecchio CMS ",
            'type'      => 'info',
            'backend'   => 1,
        ));
    }
}