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

class AttachmentsFormBigFilesController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang               = $this->params()->fromRoute('lang');
        $languageSelection  = $this->params()->fromRoute('languageSelection');
        $moduleCode         = $this->params()->fromRoute('module');
        $referenceId        = $this->params()->fromRoute('referenceId');
        $attachmentId       = $this->params()->fromRoute('attachmentId');

        $this->layout()->setVariables(array(
                'templatePartial' => 'attachments/attachments-form-big-files.phtml',
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}