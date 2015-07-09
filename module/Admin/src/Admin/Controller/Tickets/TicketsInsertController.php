<?php

namespace Admin\Controller\Tickets;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Tickets\TicketsControllerHelper;
use ModelModule\Model\Tickets\TicketsForm;
use ModelModule\Model\Tickets\TicketsFormInputFilter;
use ModelModule\Model\NullException;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class TicketsInsertController extends SetupAbstractController
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

        $inputFilter = new TicketsFormInputFilter();

        $form = new TicketsForm();
        $form->setBindOnValidate(false);
        $form->setInputFilter( $inputFilter->getInputFilter() );
        $form->setData($post);

        $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();
        $configurations = $this->layout()->getVariable('configurations');

        $helper = new TicketsControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper->setLoggedUser($userDetails);
            $helper->insertTicket($inputFilter);
            $lastInsertId = $helper->getConnection()->lastInsertId();
            $helper->insertTicketMessage($inputFilter, $lastInsertId);
            $helper->getConnection()->commit();

            /*
            $usersRecords = $helper->recoverWrapperRecords(
                new UsersGetterWrapper(new UsersGetter($em)),
                array('roleName' => 'WebMaster')
            );
            $helper->checkRecords($usersRecords, 'Nessun utente a cui inviare la segnalazione &egrave; stato trovato');

            foreach($usersRecords as $user) {
                $message = new Message();
                $message->addTo($user['email'])
                        ->addFrom('noreply@comune.it')
                        ->setSubject('Nuova richiesta di assistenza da '.$configurations['sitename'])
                        ->setBody($inputFilter->message);

                $transport = new SendmailTransport();
                $transport->send($message);
            }
            */

            /* Send email */
            $message = new Message();
            $message->addTo('a.fiori@cheapnet.it')
                    ->addFrom('noreply@comune.it')
                    ->setSubject('Nuova richiesta di assistenza da '.$configurations['sitename'])
                    ->setBody($inputFilter->message);

            $transport = new SendmailTransport();
            $transport->send($message);

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Nuova richiesta assistenza ".$inputFilter->subject,
                'type'          => 'info',
                'reference_id'  => $lastInsertId,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                => 'success',
                'messageTitle'               => 'Nuova richiesta assistenza inviata correttamente',
                'messageText'                => 'Riceverete una risposta nel pi&ugrave; breve tempo possibile',
                'showLinkResetFormAndShowIt' => 1,
                'backToSummaryLink' => $this->url()->fromRoute('admin/tickets-summary', array(
                    'lang' => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco richieste",
            ));

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $ex) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore inserimento nuova richiesta assistenza: ".$inputFilter->subject,
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento nuova richiesta assistenza',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form di inserimento dati',
            ));
        }

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}