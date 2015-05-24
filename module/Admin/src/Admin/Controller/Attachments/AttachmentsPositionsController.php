<?php

namespace Admin\Controller\Attachments;

use Admin\Model\Attachments\AttachmentsFormControllerHelper;
use Admin\Model\Modules\ModulesGetter;
use Admin\Model\Modules\ModulesGetterWrapper;
use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;
use Application\Model\NullException;
use Application\Controller\SetupAbstractController;

class AttachmentsPositionsController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $moduleCode  = $this->params()->fromRoute('module');
        $referenceId = $this->params()->fromRoute('referenceId');
        $em          = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $helper = new AttachmentsFormControllerHelper();
            $helper->setModulesGetterWrapper( new ModulesGetterWrapper(new ModulesGetter($em)) );
            $helper->setupModuleRecords($moduleCode);
            $helper->setAttachmentsGetterWrapper( new AttachmentsGetterWrapper(new AttachmentsGetter($em)) );
            $helper->setupAttachmentsRecords( array(
                    'moduleId'      => $moduleCode,
                    'referenceId'   => $referenceId,
                    'orderBy'       => 'ao.position'
                )
            );
            $helper->setModuleCode($moduleCode);
            $helper->checkModuleRecords();
            $helper->setupPropertiesGetterClassPath();
            $helper->setupPropertiesGetterClassInstance();
            $helper->getPropertiesGetterClassInstance()->setModuleCode($moduleCode);
            $helper->getPropertiesGetterClassInstance()->setEntityManager($em);
            $helper->getPropertiesGetterClassInstance()->setAttachmentsReferenceId($referenceId);
            $helper->getPropertiesGetterClassInstance()->setupProperties();

            $attachmentRecord = $helper->getAttachmentRecords();
            if (empty($attachmentRecord)) {
                throw new NullException("Nessun file allegato trovato");
            }

            $this->layout()->setVariables( array(
                    'attachmentsList'                   => $helper->getAttachmentRecords(),
                    'articleTitle'                      => $helper->getPropertiesGetterClassInstance()->getAttachmentFormTitle(),
                    'attachmentType'                    => $helper->getModuleCode(),
                    'moduleCode'                        => $moduleCode,
                    'referenceId'                       => $referenceId,
                    'formBreadCrumbCategory'            => $helper->getPropertiesGetterClassInstance()->getBreadcrumbModule(),
                    'formBreadCrumbCategoryLink'        => $this->url()->fromRoute(
                        $helper->getPropertiesGetterClassInstance()->getBreadcrumbRoute(),
                        array('lang' => 'it')
                    ),
                    'records'                           => $attachmentRecord,
                    'templatePartial'                   => 'attachments/attachments-positions.phtml',
                )
            );

        } catch(NullException $e) {
            $this->layout()->setVariables( array(
                    'templatePartial'   => 'message.phtml',
                    'messageType'       => 'danger',
                    'messageTitle'      => 'Si &egrave; verificato un errore',
                    'messageText'       => $e->getMessage(),
                )
            );
        }

        $this->layout()->setTemplate($mainLayout);
    }
}