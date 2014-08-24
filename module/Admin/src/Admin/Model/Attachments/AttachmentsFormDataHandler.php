<?php

namespace Admin\Model\Attachments;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;

/**
 * TODO:
 *      must select attachments
 *      must select record of the module to associate
 * 
 * @author Andrea Fiori
 * @since  20 August 2014
 */
class AttachmentsFormDataHandler extends FormDataAbstract
{
    private $categorieFormDataHandlerHelper;
    
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        
        $form = new AttachmentsForm();
        
        $associatedElementRecord = array();
        
        $attachmentsRecords = $this->getAttachmentsRecords(array(
                'moduleId'      => null,
                'referenceId'   => isset($param['route']['id']) ? $param['route']['id'] : null,
            )
        );
        
        $this->setVariables(array(
                'formTitle'                 => 'Allegati',
                'formDescription'           => '',
                'form'                      => $form,
                'formAction'                => '',
                'formBreadCrumbCategory'    => 'Allegati',
                '$associatedElementRecord'  => '',
                'attachmentsRecords'        => '',
            )
        );
        
        $this->setTemplate('formdata/attachments.phtml');
    }
    
    private function getAttachmentsRecords(array $input)
    {
        $wrapper = new AttachmentsGetterWrapper(new AttachmentsGetter($this->getInput("entityManager",1)));
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();
        
        return $wrapper->getRecords();
    }
}

