<?php

namespace Admin\Controller\Attachments;

use ModelModule\Model\Attachments\AttachmentsForm;
use ModelModule\Model\Attachments\AttachmentsFormControllerHelper;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;
use ModelModule\Model\Modules\ModulesGetter;
use ModelModule\Model\Modules\ModulesGetterWrapper;
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