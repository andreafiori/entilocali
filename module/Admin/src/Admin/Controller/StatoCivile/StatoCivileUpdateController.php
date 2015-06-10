<?php

namespace Admin\Controller\StatoCivile;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use ModelModule\Model\StatoCivile\StatoCivileForm;
use ModelModule\Model\StatoCivile\StatoCivileFormInputFilter;

class StatoCivileUpdateController extends SetupAbstractController
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

        $inputFilter = new StatoCivileFormInputFilter();

        $form = new StatoCivileForm();
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

            $helper = new StatoCivileControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);
            $helper->update($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::stato_civile_id,
                'message'       => "Aggiornato atto stato civile ".$inputFilter->titolo,
                'type'          => 'info',
                'description'   => '',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Atto stato civile aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna al form atto",
                'backToSummaryLink'     => $this->url()->fromRoute('admin/stato-civile-summary', array(
                    'lang' => $this->params()->fromRoute('lang'),
                )),
                'attachmentsLink'       => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => $this->params()->fromRoute('lang'),
                    'module'        => 'stato-civile',
                    'referenceId'   => $inputFilter->id,
                )),
                'backToSummaryText' => "Elenco atti stato civile",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::stato_civile_id,
                'message'       => "Errore aggiornamento atto stato civile ".$inputFilter->titolo,
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento atto stato civile',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}