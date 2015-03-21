<?php

namespace Admin\Model\Attachments;

use Admin\Model\FormData\CrudHandlerAbstract;
use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\Amazon\S3\S3;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AttachmentsCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName              = 'zfcms_attachments';
    private $tableName_options      = 'zfcms_attachments_options';
    private $tableName_relations    = 'zfcms_attachments_relations';

    protected function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            $request = $this->getInput('request', 1);

            $formPost = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $form = new AttachmentsForm();
            $form->addInputFile();
            $form->addSecondaryFields();
            $form->setData($formPost);

            /*
             * why the form is INVALID ?????????????????????????????
            if ( !$form->isValid() ) {
                $this->setErrorMessage('Dati inseriti nel form non validi');
                return false;
            }
            */

            if (!isset($formPost['s3_directory'])) {
                $this->setErrorMessage('Nome cartella di destinazione file non presente');
                return false;
            }

            $formFilter = new AttachmentsFormFilter();
            $form->setInputFilter($formFilter->getInputFilter());                        

            // Validate file extension...
            
            // Validate file size...

            // Select MIME
            $wrapper = new AttachmentsMimetypeGetterWrapper(new AttachmentsMimetypeGetter($this->getInput('entityManager',1)));
            $wrapper->setInput(array('mimetype' => $formPost['attachmentFile']['type']));
            $wrapper->setupQueryBuilder();
            $mimeRecords = $wrapper->getRecords();
            if (!$mimeRecords) {
                $this->setErrorMessage('Mime non trovato');
                return false;
            }
            
            // Insert on attachments
            $this->getConnection()->insert($this->tableName, array(
                'name'          => $formPost['attachmentFile']['name'],
                'size'          => $formPost['attachmentFile']['size'],
                'state'         => null,
                'insert_date'   => date("Y-m-d H:i:s"),
                'mime_id'       => $mimeRecords[0]['id'],
                'user_id'       => $formPost['userId'],
            ));
            
            $attachmentLastId = $this->getConnection()->lastInsertId();
            
            // Insert attachment options
            $lastId = $this->getConnection()->lastInsertId();
            $this->getConnection()->insert($this->tableName_options, array(
                'title'         => $formPost['title'],
                'description'   => $formPost['description'],
                'expire_date'   => date("Y-m-d H:i:s"),
                'attachment_id' => $this->getConnection()->lastInsertId(),
                'language_id'   => 1,
            ));

            $this->getConnection()->update($this->tableName, array(
                    'name' => AttachmentsContainer::assignFileName($formPost['attachmentFile']['name'], $lastId)
                ),
                array('id' => $lastId)
            );

            // Insert relations
            $this->getConnection()->insert($this->tableName_relations, array(
                'attachment_id' => $attachmentLastId,
                'reference_id'  => $formPost['referenceId'],
                'module_id'     => $formPost['moduleId'],
            ));
            
            $appConfigurationsFromDb = $this->getInput('configurations',1);

            // Upload on S3
            $filename = AttachmentsContainer::assignFileName($formPost['attachmentFile']['name'], $lastId);
            $s3 = new S3($appConfigurationsFromDb['amazon_s3_accesskey'], $appConfigurationsFromDb['amazon_s3_secretkey']);
            $s3->putObject(
                S3::inputFile($formPost['attachmentFile']['tmp_name'], false),
                $appConfigurationsFromDb['amazon_s3_bucket'],
                $formPost['s3_directory'].'/'.$filename,
                S3::ACL_PUBLIC_READ
            );
  
            $this->getConnection()->commit();

            $this->setSuccessMessage();
            
            // Reload page using Javascript
            $this->setVariables(array(
                    'reloadPage' => 1
                )
            );

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    protected function update()
    {
        $this->getConnection()->beginTransaction();
        try {
            $this->setArrayRecordToHandle('titolo', 'expireDate');

            $this->getConnection()->update($this->tableName, 
                    $this->getArrayRecordToHandle(),
                    array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            $this->setSuccessMessage();
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }

    /**
     * DELETE attachment file from database and S3 storage
     *
     * @param $id
     */
    protected function delete($id)
    {
        $this->getConnection()->beginTransaction();
        try {
            // delete relation record
            $this->getConnection()->delete($this->tableName_relations,
                array('attachment_id' => $id)
            );

            // delete option record
            $this->getConnection()->delete($this->tableName_options,
                array('attachment_id' => $id)
            );

            // delete attachment record
            $this->getConnection()->delete($this->tableName,
                array('id' => $id)
            );

            $this->getConnection()->commit();

            return true;

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }

    public function deleteFromS3($id, $filename)
    {

    }
}



