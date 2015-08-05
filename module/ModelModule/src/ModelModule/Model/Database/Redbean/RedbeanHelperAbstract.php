<?php

namespace ModelModule\Model\Database\Redbean;
use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\NullException;

/**
 * RedBean 3 Helper Abstraction
 *
 * @author Andrea Fiori
 * @since  21 February 2015
 */
abstract class RedbeanHelperAbstract
{
    const attachmentsTempDir = 'public/migrazione_allegati/';

    /**
     * @param array $connectionParams
     */
    public function __construct(array $connectionParams)
    {
        R::setup('mysql:host='.$connectionParams['host'].';dbname='.$connectionParams['dbname'], $connectionParams['user'], $connectionParams['password']);
    }

    /**
     * Recover multiple records
     *
     * @param string $q
     * @return array
     */
    public function getRecords($q)
    {
        try {
            return R::getAll($q);
        }  catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Execute a single query directly
     *
     * @param string $q
     * @return int|string
     */
    public function executeQuery($q)
    {
        R::begin();
        try {
            $result = R::exec($q);
            R::commit();
            return $result;
        }  catch (\Exception $ex) {
            R::rollback();
            return $ex->getMessage();
        }
    }

    /**
     * Execute multiple queries
     *
     * @param array $q
     * @return bool
     */
    public function executeMultipleQuery(array $q)
    {
        foreach ($q as $query) {
            R::begin();
            try {
                R::exec($query);
                R::commit();
                return true;
            } catch (\Exception $ex) {
                R::rollback();
                return false;
            }
        }

        return false;
    }

    /**
     * Truncate attachments tables executing a query with redbean
     */
    public function truncateAttachmentsTables()
    {
        $this->executeQuery("TRUNCATE TABLE zfcms_attachments ");

        $this->executeQuery("TRUNCATE TABLE zfcms_attachments_relations ");
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function deleteAllDirTempFile($dir)
    {
        $directoryPath = self::attachmentsTempDir.$dir;

        if (!is_dir($directoryPath)) {

        }

        foreach (new \DirectoryIterator($directoryPath) as $fileInfo) {
            if(!$fileInfo->isDot()) {
                unlink($fileInfo->getPathname());
            }
        }

        return true;
    }

    /**
     * Insert attachment record into db
     *
     * @param string $newAttachmentFilename
     * @param array $attachmentRecord
     * @return int|string
     */
    public function insertAttachment($newAttachmentFilename, $attachmentRecord)
    {
        return $this->executeQuery("INSERT INTO zfcms_attachments (title, description, name, size, status, insert_date, mime_id, user_id) (SELECT nome, '', '$newAttachmentFilename', size, 'active', NOW(), id_mime, 1 FROM contenuti_allegati WHERE id = '".$attachmentRecord['id']."' ) ");
    }

    /**
     * Insert attachment record relation into db
     *
     * @param int $attachmentId
     * @param array $attachmentRecord
     * @param int $moduleId
     * @return int|string
     */
    public function insertAttachmentRelation($attachmentId, $referenceId, $moduleId)
    {
        return $this->executeQuery("INSERT INTO zfcms_attachments_relations (attachment_id, reference_id, module_id) VALUES ('".$attachmentId."', ".$referenceId.", '".$moduleId."' ) ");
    }

    /**
     * Check the RedBean query result. Throw a new NullException in case of error
     *
     * @param mixed $result
     * @throws NullException
     */
    public function checkRedBeanQueryResult($result)
    {
        if (!is_numeric($result) or $result < 0) {
            throw new NullException($result);
        }
    }

    /**
     * Return the last insert ID (RedBean)
     *
     * @return array
     */
    public function recoverLastInsertId()
    {
        $lastInsertId = $this->getRecords("SELECT last_insert_id() AS last_insert_id ");
        if (!empty($lastInsertId)) {
            return $lastInsertId[0]['last_insert_id'];
        }

        return false;
    }

    /**
     * Save file to the temporary directory assigning permissions
     *
     * @param string $dir
     * @param string $filename
     * @param string $fileContent
     */
    public function saveFileToFileSystem($dir, $filename, $fileContent)
    {
        $pathFile = RedbeanHelperAbstract::attachmentsTempDir.$dir.$filename;
        $fp = fopen($pathFile, 'w+');
        if (is_resource($fp)) {
            fwrite($fp, $fileContent);
            fclose($fp);
        }

        chmod($pathFile, 0777);
    }

    /**
     * Upload a file on AWS S3 [UNUSED for now]
     *
     * @param array $configurations
     * @param string $dir
     * @param string $filename
     * @param string $fileContent
     * @param string $mimeType
     */
    public static function updloadToS3($configurations, $dir, $filename, $fileContent, $mimeType)
    {
        $s3 = new S3($configurations['amazon_s3_accesskey'], $configurations['amazon_s3_secretkey']);
        $s3->putObject(
            $fileContent,
            $configurations['amazon_s3_bucket'],
            $dir.$filename,
            S3::ACL_PUBLIC_READ,
            array(),
            array('Content-Type' => $mimeType)
        );
    }
}