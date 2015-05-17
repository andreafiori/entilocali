<?php

namespace Admin\Controller\Attachments;

use Admin\Model\Attachments\AttachmentsForm;
use Admin\Model\Attachments\AttachmentsFormControllerHelper;
use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;
use Admin\Model\Modules\ModulesGetter;
use Admin\Model\Modules\ModulesGetterWrapper;
use Application\Controller\SetupAbstractController;

class AttachmentsFormUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $moduleCode = $this->params()->fromRoute('module');

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new AttachmentsFormControllerHelper();
        $helper->setModulesGetterWrapper( new ModulesGetterWrapper(new ModulesGetter($em)) );
        $helper->setupModuleRecords($moduleCode);
        $helper->setAttachmentsGetterWrapper( new AttachmentsGetterWrapper(new AttachmentsGetter($em)) );
        $helper->setupAttachmentsRecords(array(
            'moduleId'      => $moduleCode,
            'referenceId'   => $id,
        ));

        $attachmentRecords = $helper->getAttachmentRecords();

        $defaultFormInput = array(
            'userId'            => $this->layout()->getVariable('userDetails')->id,
            'referenceId'       => $id,
            'moduleId'          => $helper->recoverModuleId(),
            's3_directory'      => $moduleCode
        );

        if (!empty($attachmentRecords)) {
            $formInput = array_merge($attachmentRecords[0], $defaultFormInput);
        } else {
            $formInput = $defaultFormInput; // TODO: do not allow empty forms... throw an exception!
        }

        $form = new AttachmentsForm();
        $form->addInputFile();
        $form->addSecondaryFields();
        $form->setData($formInput);

        $this->layout()->setVariables(array(
                'form'                       => $form,
                'formTitle'                  => 'Modifica allegato',
                'formDescription'            => 'Aggiorna file e\o relative informazioni',
                'formAction'                 => 'attachments/update',
                'attachmentType'             => $moduleCode,
                'templatePartial'            => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}