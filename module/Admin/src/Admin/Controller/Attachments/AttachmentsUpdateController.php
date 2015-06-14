<?php

namespace Admin\Controller\Attachments;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Attachments\AttachmentsControllerHelper;
use ModelModule\Model\Attachments\AttachmentsForm;
use ModelModule\Model\Attachments\AttachmentsFormInputFilter;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;

/**
 * TODO: if file is uploaded, delete old file, upload new file, update file info
 */
class AttachmentsUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $em->getConnection();

        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $inputFilter = new AttachmentsFormInputFilter();

        $form = new AttachmentsForm();
        $form->setBindOnValidate(false);
        $form->setInputFilter( $inputFilter->getInputFilter() );
        $form->setData($post);

        $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper = new AttachmentsControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);
            $helper->updateOptions($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Aggiornato file allegato ".$inputFilter->title,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Allegato aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna ai dati dell'allegato",
                'backToSummaryText'     => "Elenco allegati",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore aggiornamento file allegato",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento file allegato',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al file allegato',
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}