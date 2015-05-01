<?php

namespace Application\Controller\Contacts;

use Zend\Mail;
use Application\Controller\SetupAbstractController;
use Application\Model\Contacts\ContactsForm;
use Application\Model\NullException;

class ContactsController extends SetupAbstractController
{
    public function indexAction()
    {


        $form     = new ContactsForm();
        $request  = $this->getInput('request');
        $template = 'contatti/contatti.phtml';

        if (!is_object($request)) {
            return false;
        }

        if ( $request->isPost() ) {
            $form->setInputFilter( new ContactsFormValidator() );
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $formData = $request->getPost();

                $configurations = $this->getInput('configurations', 1);

                try {
                    $mail = new Mail\Message();
                    $mail->setFrom($configurations['emailnoreply'], $formData->nome.' '.$formData->cognome);
                    $mail->addTo($configurations['emailcontact'], $configurations['sitename']);
                    $mail->setSubject('Nuovo messaggio dal sito '.$configurations['sitename']);
                    $mail->setBody("Nome e cognome: \n ".$formData->nome." ".$formData->cognome." Email: ".$formData->email."\n Messaggio: ".$formData->messaggio);

                    $transport = new Mail\Transport\Sendmail();
                    $transport->send($mail);
                } catch (NullException $e) {
                    echo $e->getMessage();
                }

                $this->setVariable('inviato', 1);

                $template = 'contatti/ok.phtml';

            } else {
                $flashMessenger = $this->getInput('flashMessenger');
                foreach ($form->getInputFilter()->getInvalidInput() as $invalidInput) {
                    $flashMessenger->addMessage( $form->getMessages() );
                }
                $this->setVariable('messages', $flashMessenger->getMessages());
            }
        }

        $this->setTemplate($template);
        $this->setVariable('form', $form);

        return $this->getOutput();
    }

    public function sendAction()
    {

    }
}