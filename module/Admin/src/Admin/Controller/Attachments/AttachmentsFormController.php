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

/**
 * @author Andrea Fiori
 * @since  17 April 2015
 */
class AttachmentsFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $option         = $this->params()->fromRoute('module');
        $id             = $this->params()->fromRoute('id');
        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $helper = new AttachmentsFormControllerHelper();
            $helper->setModulesGetterWrapper( new ModulesGetterWrapper(new ModulesGetter($em)) );
            $helper->setupModuleRecords($option);

            $wrapper = new AttachmentsGetterWrapper(new AttachmentsGetter($em));
            $wrapper->setInput(array(
                'moduleId'      => $option,
                'status'        => 1,
                'referenceId'   => $id,
            ));
            $wrapper->setupQueryBuilder();

            $attachmentsRecords = $wrapper->getRecords();

            switch($option) {
                default:
                    throw new NullException("Modulo non rilevato. Impossibile mostrare gli allegati ed il relativo form :(");
                break;

                case("albo-pretorio"):
                    $wrapper = new \Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper(
                        new \Admin\Model\AlboPretorio\AlboPretorioArticoliGetter($em)
                    );
                    $wrapper->setInput(array(
                        'id'        => is_numeric($option) ? $option : null,
                        'fields'    => 'alboArticoli.id, alboArticoli.titolo'
                    ));
                    $wrapper->setupQueryBuilder();

                    $relatedRecord = $wrapper->getRecords();

                    $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                    $breadCrumbModule = 'Albo pretorio';

                    $breadCrumbLink = $this->url()->fromRoute('admin/albo-pretorio-summary', array('lang' => 'it') );
                break;

                case("stato-civile"):
                    $wrapper = new \Admin\Model\StatoCivile\StatoCivileGetterWrapper(
                        new \Admin\Model\StatoCivile\StatoCivileGetter($em)
                    );
                    $wrapper->setInput(array(
                        'id' => $option
                    ));
                    $wrapper->setupQueryBuilder();

                    $relatedRecord = $wrapper->getRecords();

                    $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                    $breadCrumbModule = 'Stato civile';

                    $breadCrumbLink = $this->url()->fromRoute('admin/stato-civile-summary', array('lang' => 'it') );
                break;

                case("contratti-pubblici"):
                    $wrapper = new \Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper(
                        new \Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter($em)
                    );
                    $wrapper->setInput(array('id' => $option));
                    $wrapper->setupQueryBuilder();

                    $relatedRecord = $wrapper->getRecords();

                    $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                    $breadCrumbModule = 'Contratti pubblici';
                break;

                case("atti-concessione"):
                    $wrapper = new \Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper(
                        new \Admin\Model\AttiConcessione\AttiConcessioneGetter($em)
                    );
                    $wrapper->setInput(array('id' => $option));
                    $wrapper->setupQueryBuilder();

                    $relatedRecord = $wrapper->getRecords();

                    $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                    $breadCrumbModule = 'Atti concessione';

                    $breadCrumbLink = $this->url()->fromRoute('admin/atti-concessione-summary', array('lang' => 'it') );
                break;

                case("contenuti"):
                    $wrapper = new \Admin\Model\Contenuti\ContenutiGetterWrapper(
                        new \Admin\Model\Contenuti\ContenutiGetter($em)
                    );
                    $wrapper->setInput(array('id' => $option));
                    $wrapper->setupQueryBuilder();

                    $relatedRecord = $wrapper->getRecords();

                    $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                    $breadCrumbModule = 'Contenuti';

                    $breadCrumbLink = $this->url()->fromRoute('admin/contenuti-summary', array('lang' => 'it') );
                break;

                case("amministrazione-trasparente"):
                    $wrapper = new \Admin\Model\Contenuti\ContenutiGetterWrapper(
                        new \Admin\Model\Contenuti\ContenutiGetter($em)
                    );
                    $wrapper->setInput(array('id' => $option));
                    $wrapper->setupQueryBuilder();

                    $relatedRecord = $wrapper->getRecords();

                    $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                    $breadCrumbModule = 'Amministrazione Trasparente';

                    $breadCrumbLink = $this->url()->fromRoute('admin/contenuti-summary', array('lang' => 'it') );
                break;
            }

            $form = new AttachmentsForm();
            $form->addInputFile();
            $form->addSecondaryFields();
            $form->setData(array(
                'userId'            => $this->layout()->getVariable('userDetails')->id,
                'referenceId'       => $id,
                'moduleId'          => $helper->recoverModuleId(),
                's3_directory'      => $option
            ));

            $this->layout()->setVariables(array(
                    'form'                       => $form,
                    'formTitle'                  => 'Nuovo allegato',
                    'formDescription'            => 'La dimensione del file non deve superare i <strong>10MB</strong>.',
                    'formAction'                 => 'attachments/insert',
                    'attachmentsList'            => $attachmentsRecords,
                    'articleTitle'               => $articleTitle,
                    'hideBreadcrumb'             => 1,
                    'formBreadCrumbCategory'     => $breadCrumbModule, $articleTitle,
                    'formBreadCrumbCategoryLink' => $breadCrumbLink,
                    'attachmentType'             => $option,
                    'templatePartial'            => 'formdata/attachments.phtml',
                )
            );

            $this->layout()->setTemplate($mainLayout);

        } catch(NullException $e) {
            $this->layout()->setVariables(array(
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'danger',
                'messageTitle'      => 'Si &egrave; verificato un errore!',
                'messageText'       => $e->getMessage(),
            ));
            $this->layout()->setTemplate($mainLayout);
            return false;
        }
    }
}