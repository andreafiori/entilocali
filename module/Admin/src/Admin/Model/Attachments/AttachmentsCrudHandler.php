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
    private $validExtensions = array('txt','doc','docx','xls','xlsx','pdf','jpg','rtf','ods','zip');
    
    protected function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            $request = $this->getInput('request', 1);

            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            
            $form = new AttachmentsForm();
            $form->addInputFile();
            $form->addSecondaryFields();
            $form->setData($post);
            if ( !$form->isValid() ) {
                $this->setErrorMessage('Dati inseriti nel form non validi');
                return false;
            }
            
            if (!isset($post['s3_directory'])) {
                $this->setErrorMessage('Nome cartella di destinazione file non presente');
                return false;
            }

            $formFilter = new AttachmentsFormFilter();
            $form->setInputFilter($formFilter->getInputFilter());                        

            // Validate extension
            
            // Validate size
            
            // Rename file extension before store it
            
            $fileExtension = pathinfo($post['attachmentFile']['name'], PATHINFO_EXTENSION);
            
            // select MIME
            $wrapper = new AttachmentsMimetypeGetterWrapper(new AttachmentsMimetypeGetter($this->getInput('entityManager',1)));
            $wrapper->setInput(array('mimetype' => $post['attachmentFile']['type']));
            $wrapper->setupQueryBuilder();
            $mimeRecords = $wrapper->getRecords();
            if (!$mimeRecords) {
                $this->setErrorMessage('Mime non trovato');
                return false;
            }
            
            // insert on attachments
            $this->getConnection()->insert($this->tableName, array(
                'name'          => $post['attachmentFile']['name'],
                'size'          => $post['attachmentFile']['size'],
                'state'         => null,
                'insert_date'   => date("Y-m-d H:i:s"),
                'expire_date'   => date("Y-m-d H:i:s"),
                'mime_id'       => $mimeRecords[0]['id'],
                'user_id'       => $post['userId'],
            ));
            
            $attachmentLastId = $this->getConnection()->lastInsertId();
            
            // insert attachment options
            $this->getConnection()->insert($this->tableName_options, array(
                'title'         => $post['title'],
                'description'   => $post['description'],
                'attachment_id' => $this->getConnection()->lastInsertId(),
                'language_id'   => 1,
            ));
            
            // insert relations
            $this->getConnection()->insert($this->tableName_relations, array(
                'attachment_id' => $attachmentLastId,
                'reference_id'  => $post['referenceId'],
                'module_id'     => $post['moduleId'],
            ));
            
            $appConfigurationsFromDb = $this->getInput('configurations',1);

            // Upload on S3
            $filename = $post['attachmentFile']['name'];
            $s3 = new S3($appConfigurationsFromDb['amazon_s3_accesskey'], $appConfigurationsFromDb['amazon_s3_secretkey']);
            $s3->putObject(S3::inputFile($post['attachmentFile']['tmp_name'], false), $appConfigurationsFromDb['amazon_s3_bucket'], $post['s3_directory'].'/'.$filename, S3::ACL_PUBLIC_READ);
  
            $this->getConnection()->commit();

            $this->setSuccessMessage();
            
            // Redirect
            // $redirect = $this->getInput('redirect', 1);
            // $redirect->toRoute('admin/formdata', array("lang"=> 'it', 'formsetter' => ''));

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    protected function update()
    {
        $appConfigurationsFromDb = $this->getInput('configurations',1);
        
        try {
            $this->setArrayRecordToHandle('titolo', 'titolo');

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
    
    protected function delete()
    {
        // TODO
    }
}



