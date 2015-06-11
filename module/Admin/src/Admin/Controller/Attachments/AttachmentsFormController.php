<?php

namespace Admin\Controller\Attachments;

use ModelModule\Model\Attachments\AttachmentsFormControllerHelper;
use ModelModule\Model\Modules\ModulesGetter;
use ModelModule\Model\Modules\ModulesGetterWrapper;
use ModelModule\Model\Attachments\AttachmentsForm;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;
use ModelModule\Model\NullException;
use Application\Controller\SetupAbstractController;

class AttachmentsFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang           = $this->params()->fromRoute('lang');
        $moduleCode     = $this->params()->fromRoute('module');
        $referenceId    = $this->params()->fromRoute('referenceId');
        $attachmentId   = $this->params()->fromRoute('attachmentId');

        try {
            $helper = new AttachmentsFormControllerHelper();
            $helper->setModulesGetterWrapper( new ModulesGetterWrapper(new ModulesGetter($em)) );
            $helper->setupModuleRecords($moduleCode);
            $helper->setAttachmentsGetterWrapper( new AttachmentsGetterWrapper(new AttachmentsGetter($em)) );
            if ($attachmentId) {
                $helper->setupAttachmentsRecords(array(
                    'moduleId'      => $moduleCode,
                    'referenceId'   => $referenceId,
                    'status'        => 1,
                    'attachmentId'  => $attachmentId,
                ));
            }
            $helper->setModuleCode($moduleCode);
            $helper->checkModuleRecords();
            $helper->setupPropertiesGetterClassPath();
            $helper->setupPropertiesGetterClassInstance();
            $helper->getPropertiesGetterClassInstance()->setModuleCode($moduleCode);
            $helper->getPropertiesGetterClassInstance()->setEntityManager($em);
            $helper->getPropertiesGetterClassInstance()->setAttachmentsReferenceId($referenceId);
            $helper->getPropertiesGetterClassInstance()->setupProperties();
            $helper->setAttachmentsForm( new AttachmentsForm() );
            $helper->buildForm( $helper->getAttachmentRecords() );

            $formBasicInput = array(
                'userId'            => $this->layout()->getVariable('userDetails')->id,
                'referenceId'       => $referenceId,
                'moduleId'          => $helper->recoverModuleId(),
                's3_directory'      => $moduleCode
            );

            $attachmentRecord = $helper->getAttachmentRecords();
            if (!empty($attachmentRecord)) {
                $formInput = array_merge($formBasicInput, $attachmentRecord[0]);
                $formTitle = $attachmentRecord[0]['title'];
            } else {
                $formInput = $formBasicInput;
                $formTitle = 'Nuovo allegato';
            }

            $helper->getAttachmentsForm()->setData($formInput);

            $this->layout()->setVariables(array(
                    'form'                       => $helper->getAttachmentsForm(),
                    'formTitle'                  => $formTitle,
                    'formDescription'            => 'La dimensione del file non deve superare i <strong>10MB</strong>.',
                    'formAction'                 => 'attachments/insert',
                    'hideBreadcrumb'             => 1,
                    'noFormActionPrefix'         => 1,
                    'attachmentsList'            => $helper->getAttachmentRecords(),
                    'articleTitle'               => $helper->getPropertiesGetterClassInstance()->getAttachmentFormTitle(),
                    'formBreadCrumbCategory'     => $helper->getPropertiesGetterClassInstance()->getBreadcrumbModule(),
                    'formBreadCrumbCategoryLink' => $this->url()->fromRoute(
                        $helper->getPropertiesGetterClassInstance()->getBreadcrumbRoute(),
                        array('lang' => $lang, 'languageSelection' => $lang)
                    ),
                    'breadCrumbActiveLabel'      => isset($attachmentRecord[0]['title']) ? $attachmentRecord[0]['title'] : 'Nuovo file',
                    'attachmentType'             => $helper->getModuleCode(),
                    'attachmentRecords'          => $helper->getAttachmentRecords(),
                    'referenceId'                => $referenceId,
                    'moduleCode'                 => $moduleCode,
                    'templatePartial'            => 'attachments/attachments-form.phtml',
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