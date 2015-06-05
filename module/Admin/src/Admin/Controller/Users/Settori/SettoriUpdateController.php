<?php

namespace Admin\Controller\Users\Settori;

use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Users\Settori\SettoriControllerHelper;
use ModelModule\Model\Users\Settori\UsersSettoriForm;
use ModelModule\Model\Users\Settori\UsersSettoriFormInputFilter;
use Application\Controller\SetupAbstractController;

class SettoriUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
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

        $inputFilter = new UsersSettoriFormInputFilter();

        $form = new UsersSettoriForm();
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

            $helper = new SettoriControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->update($inputFilter);
            $helper->getConnection()->commit();
            $helper->setLogWriter(new LogWriter($connection));
            $helper->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Aggiornato il settore utente ".$inputFilter->nome,
                'reference_id'  => $userDetails->id,
                'type'          => 'info',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Settore utente aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/users-settori-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco settori utente",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore nell'aggiornamento settore utente ".$inputFilter->nome.' Messaggio generato: '.$e->getMessage(),
                'reference_id'  => $userDetails->id,
                'type'          => 'error',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento settore utente',
                'messageText'           => 'Messaggio generato: ' . $e->getMessage(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco settori",
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
            ));
        }

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}