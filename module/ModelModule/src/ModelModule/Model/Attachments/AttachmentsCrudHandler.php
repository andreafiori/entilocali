<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\FormData\CrudHandlerAbstract;
use ModelModule\Model\FormData\CrudHandlerInsertUpdateInterface;
use ModelModule\Model\FormData\CrudHandlerInterface;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\Amazon\S3\S3;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AttachmentsCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    private $tableName;
    private $tableName_options;
    private $tableName_relations;

    private $moduleId;

    public function __construct()
    {
        $this->form = new AttachmentsForm();

        $this->formInputFilter = new AttachmentsFormInputFilter();

        $this->tableName = DbTableContainer::attachments;
        $this->tableName_options = DbTableContainer::attachmentsOption;
        $this->tableName_relations = DbTableContainer::attachmentsRelations;

        $this->moduleId = ModulesContainer::atti_concessione;
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        return $this->checkValidateFormDataError(
            $formData,
            array('title', 'description', 'attachmentFile', 'referenceId', 'moduleId')
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertEntityManager();

        $this->assertConnection();

        $this->assertUserDetails();

        $this->asssertConfigurationsFromDb();

        $userDetails = $this->getUserDetails();

        $configurations = $this->getConfigurationsFromDb();

        // Select MIME
        $wrapper = new AttachmentsMimetypeGetterWrapper(new AttachmentsMimetypeGetter($this->getEntityManager()));
        $wrapper->setInput(array(
                'mimetype' => $formData->attachmentFile['type'],
                'limit'    => 1,
            )
        );
        $wrapper->setupQueryBuilder();

        $mimeRecords = $wrapper->getRecords();
        if (!$mimeRecords) {
            $this->setErrorMessage("Mime non trovato! Il tipo di file inserito non &egrave; supportato. Per ulteriori informazioni contattare l'amministrazione");
            return false;
        }

        // Insert on attachments
        $this->getConnection()->insert($this->tableName, array(
            'name'          => $formData->attachmentFile['name'],
            'size'          => $formData->attachmentFile['size'],
            'state'         => null,
            'insert_date'   => date("Y-m-d H:i:s"),
            'mime_id'       => isset($mimeRecords[0]['id']) ? $mimeRecords[0]['id'] : null,
            'user_id'       => $userDetails->id,
        ));

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
        $this->getConnection()->insert($this->tableName_relations, array(
            'attachment_id' => $attachmentsTableLastInsertId,
            'reference_id'  => $formData->referenceId,
            'module_id'     => $formData->moduleId,
        ));

        return true;
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update($this->tableName_options,
            array(
                'title'       => $formData->title,
                'description' => $formData->description,
                'expire_date' => $formData->expireDate,
            ),
            array('id' => $formData->attachmenOptionId),
            array('limit' => 1)
        );
    }

    /**
     * TODO: delete from S3
     *
     * @param $id
     */
    public function delete($id)
    {
        // delete relation record
        $this->getConnection()->delete($this->tableName_relations,
            array('attachmenOptionId' => $id)
        );

        // delete option record
        $this->getConnection()->delete($this->tableName_options,
            array('attachmenOptionId' => $id)
        );

        // delete attachment record
        return $this->getConnection()->delete($this->tableName,
            array('id' => $id)
        );
    }

    /**
     * @return bool
     *
     * @throws \Application\Model\NullException
     */
    public function logInsertOk()
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Inserito nuovo atto di concessione ".$inputFilter->title,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @param null $message
     *
     * @return bool
     */
    public function logInsertKo($message = null)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Errore nell'inserimento atto di concessione ".$inputFilter->title.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @return bool
     */
    public function logUpdateOk()
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Aggiornato atto di concessione ".$inputFilter->title,
            'type'      => 'info',
            'backend'   => 1,
        ));
    }

    /**
     * @param null $message
     *
     * @return bool
     */
    public function logUpdateKo($message = null)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Errore nell'aggiornamento dell'atto di concessione ".$inputFilter->title.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}