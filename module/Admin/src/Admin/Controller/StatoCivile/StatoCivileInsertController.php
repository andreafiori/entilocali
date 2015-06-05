<?php

namespace Admin\Controller\StatoCivile;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use ModelModule\Model\StatoCivile\StatoCivileForm;
use ModelModule\Model\StatoCivile\StatoCivileFormInputFilter;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;

class StatoCivileInsertController extends SetupAbstractController
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

        $helper = new StatoCivileControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper->setLoggedUser($userDetails);
            $inputFilter->progressivo = $helper->recoverNumeroProgressivo(
                new StatoCivileGetterWrapper(new StatoCivileGetter($em))
            );
            $lastInsertId = $helper->insert($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::stato_civile_id,
                'message'       => "Inserito nuovo atto stato civile ".$inputFilter->titolo. " ID: ".$lastInsertId,
                'type'          => 'info',
                'reference_id'  => $lastInsertId,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                => 'success',
                'messageTitle'               => 'Atto stato civile inserito correttamente',
                'messageText'                => 'I dati sono stati processati correttamente dal sistema',
                'showLinkResetFormAndShowIt' => 1,
                'backToSummaryLink' => $this->url()->fromRoute('admin/stato-civile-summary', array(
                    'lang' => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText' => "Elenco atti",
                'attachmentsLink' => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => $this->params()->fromRoute('lang'),
                    'module'        => 'stato-civile',
                    'referenceId'   => $lastInsertId,
                )),
            ));

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $e) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::stato_civile_id,
                'message'       => "Errore inserimento nuovo atto stato civile: ".$inputFilter->titolo,
                'type'          => 'error',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento nuovo atto stato civile',
                'messageText'           => 'Messaggio generato: '.$e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form',
            ));
        }

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}