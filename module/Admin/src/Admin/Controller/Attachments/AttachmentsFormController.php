<?php

namespace Admin\Controller\Attachments;

use Admin\Model\Attachments\AttachmentsFormControllerHelper;
use Application\Controller\SetupAbstractController;
use Admin\Model\Modules\ModulesGetter;
use Admin\Model\Modules\ModulesGetterWrapper;
use Admin\Model\Attachments\AttachmentsForm;
use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;
use Application\Model\NullException;

class AttachmentsFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $moduleCode     = $this->params()->fromRoute('module');
        $id             = $this->params()->fromRoute('id');
        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $helper = new AttachmentsFormControllerHelper();
            $helper->setModulesGetterWrapper( new ModulesGetterWrapper(new ModulesGetter($em)) );
            $helper->setupModuleRecords($moduleCode);
            $helper->setAttachmentsGetterWrapper( new AttachmentsGetterWrapper(new AttachmentsGetter($em)) );
            $helper->setupAttachmentsRecords(array(
                'moduleId'      => $moduleCode,
                'referenceId'   => $id,
                'status'        => 1,
            ));
            $helper->setModuleCode($moduleCode);
            $helper->checkModuleRecords();
            $helper->setupPropertiesGetterClassPath();
            $helper->setupPropertiesGetterClassInstance();
            $helper->getPropertiesGetterClassInstance()->setModuleCode($moduleCode);
            $helper->getPropertiesGetterClassInstance()->setEntityManager($em);
            $helper->getPropertiesGetterClassInstance()->setAttachmentsReferenceId($id);
            $helper->getPropertiesGetterClassInstance()->setupProperties();

            $form = new AttachmentsForm();
            $form->addInputFile();
            $form->addSecondaryFields();
            $form->setData(array(
                'userId'            => $this->layout()->getVariable('userDetails')->id,
                'referenceId'       => $id,
                'moduleId'          => $helper->recoverModuleId(),
                's3_directory'      => $moduleCode
            ));

            $this->layout()->setVariables(array(
                    'form'                       => $form,
                    'formTitle'                  => 'Nuovo allegato',
                    'formDescription'            => 'La dimensione del file non deve superare i <strong>10MB</strong>.',
                    'formAction'                 => 'attachments/insert',
                    'hideBreadcrumb'             => 1,
                    'attachmentsList'            => $helper->getAttachmentRecords(),
                    'articleTitle'               => $helper->getPropertiesGetterClassInstance()->getAttachmentFormTitle(),
                    'formBreadCrumbCategory'     => $helper->getPropertiesGetterClassInstance()->getBreadcrumbModule(),
                    'formBreadCrumbCategoryLink' => $this->url()->fromRoute(
                        $helper->getPropertiesGetterClassInstance()->getBreadcrumbRoute(),
                        array('lang' => 'it')
                    ),
                    'attachmentType'             => $helper->getModuleCode(),
                    'templatePartial'            => 'formdata/attachments.phtml',
                )
            );

        } catch(NullException $e) {
            $this->layout()->setVariables(array(
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'danger',
                'messageTitle'      => 'Si &egrave; verificato un errore!',
                'messageText'       => $e->getMessage(),
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}