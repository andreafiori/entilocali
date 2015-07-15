<?php

namespace Admin\Controller\Attachments;

use ModelModule\Model\Attachments\AttachmentsFormControllerHelper;
use ModelModule\Model\AttiConcessione\AttiConcessioneColumnDisplayForm;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Modules\ModulesGetter;
use ModelModule\Model\Modules\ModulesGetterWrapper;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;
use ModelModule\Model\NullException;
use Application\Controller\SetupAbstractController;

/**
 * TODO: refactor and simplify model helper
 */
class AttachmentsSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $lang        = $this->params()->fromRoute('lang');
        $moduleCode  = $this->params()->fromRoute('module');
        $referenceId = $this->params()->fromRoute('referenceId');

        $em          = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $helper = new AttachmentsFormControllerHelper();
            $helper->setModulesGetterWrapper( new ModulesGetterWrapper(new ModulesGetter($em)) );
            $helper->setupModuleRecords($moduleCode);
            $helper->setAttachmentsGetterWrapper( new AttachmentsGetterWrapper(new AttachmentsGetter($em)) );
            $helper->setupAttachmentsRecords( array(
                'moduleId'      => ModulesContainer::recoverIdFromModuleCode($moduleCode),
                'referenceId'   => $referenceId,
                'orderBy'       => 'a.position'
            ));
            $helper->setModuleCode($moduleCode);
            $helper->checkModuleRecords();
            $helper->setupPropertiesGetterClassPath();
            $helper->setupPropertiesGetterClassInstance();
            $helper->getPropertiesGetterClassInstance()->setModuleCode($moduleCode);
            $helper->getPropertiesGetterClassInstance()->setEntityManager($em);
            $helper->getPropertiesGetterClassInstance()->setAttachmentsReferenceId($referenceId);
            $helper->getPropertiesGetterClassInstance()->setupProperties();

            if ($moduleCode=='albo-pretorio') {
                $alboRettificaColumnDisplay = 1;
            }

            if ($moduleCode=='atti-concessione') {
                $attiConcessioneColumnDisplayForm = new AttiConcessioneColumnDisplayForm();
                $attiConcessioneColumnDisplayForm->addSubmitButton();
            }

            $attachmentsRecords = $helper->getAttachmentRecords();
            $attachmentsRelatedRecords = $helper->getPropertiesGetterClassInstance()->getAttachmentsRelatedRecords();

            if (empty($attachmentsRelatedRecords)) {
                throw new NullException("Nessun dato relativo all'articolo a cui allegare il file &egrave; stato trovato");
            }

            $this->layout()->setVariables( array(
                    'hideBreadcrumb'                    => 1,
                    'attachmentsList'                   => $attachmentsRecords,
                    'attachmentsListCount'              => count($attachmentsRecords),
                    'articleTitle'                      => $helper->getPropertiesGetterClassInstance()->getAttachmentFormTitle(),
                    'attachmentType'                    => $helper->getModuleCode(),
                    'moduleCode'                        => $moduleCode,
                    'referenceId'                       => $referenceId,
                    'formBreadCrumbCategory'            => $helper->getPropertiesGetterClassInstance()->getBreadcrumbModule(),
                    'formBreadCrumbCategoryLink'        => $this->url()->fromRoute(
                        $helper->getPropertiesGetterClassInstance()->getBreadcrumbRoute(),
                        array('lang' => $lang, 'languageSelection' => $lang, 'modulename' => $moduleCode)
                    ),
                    'alboRettificaColumnDisplay'        => (isset($alboRettificaColumnDisplay)) ? $alboRettificaColumnDisplay : null,
                    'attiConcessioneCatColumnDisplay'   => (isset($attiConcessioneColumnDisplayForm)) ? 1 : null,
                    'attiConcessioneColumnDisplayForm'  => (isset($attiConcessioneColumnDisplayForm)) ? $attiConcessioneColumnDisplayForm : null,
                    'templatePartial'                   => 'attachments/attachments-summary.phtml',
                )
            );
        } catch(NullException $e) {
            $this->layout()->setVariables( array(
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'danger',
                'messageTitle'      => 'Problema verificato',
                'messageText'       => $e->getMessage(),
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}