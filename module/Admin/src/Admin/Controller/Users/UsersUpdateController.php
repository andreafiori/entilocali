<?php

namespace Admin\Controller\Users;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\Users\UsersControllerHelper;
use ModelModule\Model\Users\UsersForm;
use ModelModule\Model\Users\UsersFormInputFilter;

class UsersUpdateController extends SetupAbstractController
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

        $inputFilter = new UsersFormInputFilter();

        $form = new UsersForm();
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

            $helper = new UsersControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);
            $helper->update($inputFilter);
            // TODO: update password last update on session if the current user has been updated
            $helper->getConnection()->commit();


            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Aggiornato utente ".$inputFilter->name.' '.$inputFilter->surname,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Utente aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form utente',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/users-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco utenti",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id' => $userDetails->id,
                'module_id' => ModulesContainer::contenuti_id,
                'message' => "Errore aggiornamento utente ",
                'type' => 'error',
                'description' => $e->getMessage(),
                'reference_id' => $inputFilter->id,
                'backend' => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType' => 'danger',
                'messageTitle' => 'Errore aggiornamento utente',
                'messageText' => 'Messaggio generato: ' . $e->getMessage(),
                'form' => $form,
                'formInputFilter' => $inputFilter->getInputFilter(),
                'messageShowFormLink' => 1,
                'messageShowForm' => 'Torna al form dati utente',
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir') . 'message.phtml');
        }
    }
}