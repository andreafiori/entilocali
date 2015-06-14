<?php

namespace ModelModule\Model\Amazon\S3;

use Zend\InputFilter\InputFilterAwareInterface;

/**
 * Set S3 to upload a file
 */
class S3Helper
{
    private $s3;
    private $s3Directory;
    private $accessKey;
    private $secretKey;
    private $bucket;

    /**
     * @param S3 $s3
     */
    public function setS3(S3 $s3)
    {
        $this->s3 = $s3;
    }

    /**
     * @param $fileData
     * @param $filename
     * @param $lastId
     * @return bool
     * @throws NullException
     */
    public function upload($fileData, $filename)
    {
        $this->assertAccessKey();
        $this->assertSecretKey();
        $this->assertBucket();
        $this->assertS3Directory();
        $this->assertS3();

        return $this->getS3()->putObject(
            S3::inputFile($fileData, false),
            $this->bucket,
            $this->s3Directory.'/'.$filename,
            S3::ACL_PUBLIC_READ
        );
    }

    /**
     * @throws NullException
     */
    private function assertS3()
    {
        if (!$this->getS3()) {
            throw new NullException("AWS S3 instance is not set");
        }
    }

    /**
     * @return S3
     */
    public function getS3()
    {
        return $this->s3;
    }

    /**
     * @param $accessKey
     *
     * @throws NullException
     */
    public function setAccessKey($accessKey)
    {
        $this->accessKey = $accessKey;
    }

    /**
     * @throws NullException
     */
    private function assertAccessKey()
    {
        if (!$this->accessKey) {
            throw new NullException("AWS S3 AccessKey is not set");
        }
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @throws NullException
     */
    private function assertSecretKey()
    {
        if (!$this->secretKey) {
            throw new NullException("AWS S3 SecretKey is not set");
        }
    }

    /**
     * @param $bucket
     */
    public function setBucket($bucket)
    {
        $this->bucket = $bucket;
    }

    /**
     * @throws NullException
     */
    private function assertBucket()
    {
        if (!$this->bucket) {
            throw new NullException("AWS S3 Bucket is not set");
        }
    }

    /**
     * @param mixed $s3Directory
     */
    public function setS3Directory($s3Directory)
    {
        $this->s3Directory = $s3Directory;
    }

    public function assertS3Directory()
    {
        if (!$this->s3Directory) {
            throw new NullException("AWS S3 target directory (module code) is not set");
        }
    }

    /**
     * @param $filename
     * @param $id
     * @return mixed|string
     */
    public function assignFileName($filename, $id)
    {
        $newAttachmentFilename = str_replace(" ", "-", trim(strtolower($filename)) );
        $newAttachmentFilename = preg_replace("/[^a-zA-Z0-9.]/", "", $newAttachmentFilename);
        $newAttachmentFilename = $id.'_'.$newAttachmentFilename;

        return $newAttachmentFilename;
    }

    /**
     * @return mixed
     */
    public function getS3Directory()
    {
        return $this->s3Directory;
    }

    /**
     * @return mixed
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @return mixed
     */
    public function getBucket()
    {
        return $this->bucket;
    }
}