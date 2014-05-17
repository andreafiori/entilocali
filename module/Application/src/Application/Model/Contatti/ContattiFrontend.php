<?php

namespace Application\Model\Contatti;

use Zend\Mail;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Form\ContattiForm;
use Application\Form\ContattiFormValidator;

/**
 * Contact form frontend router
 * TODO: captcha on the form and redirect to another route URL after post
 * 
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class ContattiFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $form     = new ContattiForm();
        $request  = $this->getInput('request');
        $template = 'contatti/contatti.phtml';
        
        if (!is_object($request)) {
            return false;
        }

        if ( $request->isPost() ) {
            $form->setInputFilter( new ContattiFormValidator() );
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                //$redirect = $this->getInput('redirect');
                $formData = $request->getPost();

                $configurations = $this->getInput('configurations', 1);

                $mail = new Mail\Message();
                $mail->setFrom($configurations['emailnoreply'], $formData->nome.' '.$formData->cognome);
                $mail->addTo($configurations['emailcontact'], $configurations['sitename']);    
                $mail->setSubject('Nuovo messaggio dal sito '.$configurations['sitename']);
                $mail->setBody("Nome e cognome: \n ".$formData->nome." ".$formData->cognome." Email: ".$formData->email."\n Messaggio: ".$formData->messaggio);

                $transport = new Mail\Transport\Sendmail();
                $transport->send($mail);

                $this->setVariable('inviato', 1);

                $template = 'contatti/ok.phtml';

            } else {
                $flashMessenger   = $this->getInput('flashMessenger');
                foreach ($form->getInputFilter()->getInvalidInput() as $invalidInput) {                    
                    $flashMessenger->addMessage('My message error');
                }
                $this->setVariable('messages', $flashMessenger->getMessages());
            }
        }
        
        $this->setTemplate($template);
        $this->setVariable('form', $form);

        return $this->getOutput();
    }
}
