<?php

namespace Application\Model\Contatti;

use Zend\Mail;
use Application\Model\FrontendHelpers\FrontendRouterAbstract;
use Application\Model\FrontendHelpers\FrontendRouterInterface;
use Application\Form\ContactForm;
use Application\Form\ContactFormValidator;

/**
 * Contact form frontend router
 * TODO: captcha on the form and redirect to another route URL after post
 * 
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class ContattiFrontend extends FrontendRouterAbstract implements FrontendRouterInterface
{
    public function setupFrontendRecord()
    {  
        $form    = new ContactForm();
        $request = $this->getInput('request');
 
        if ( $request->isPost() ) {
            $form->setInputFilter( new ContactFormValidator() );
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $formData = $request->getPost();

                $configurations = $this->getInput('configurations', 1);

                $mail = new Mail\Message();
                $mail->setFrom($configurations['emailnoreply'], $formData->nome.' '.$formData->cognome);
                $mail->addTo($configurations['emailcontact'], $configurations['sitename']);    
                $mail->setSubject('Nuovo messaggio dal sito '.$configurations['sitename']);
                $mail->setBody("Nome e cognome: \n ".$formData->nome." ".$formData->cognome." Email: ".$formData->email."\n Messaggio: ".$formData->messaggio);

                $transport = new Mail\Transport\Sendmail();
                $transport->send($mail);

                $this->setFrontendVariable('inviato', 1);

                $this->setTemplate('contatti/ok.phtml');
                return $this->getOutput();

            } else {
                foreach ($form->getInputFilter()->getInvalidInput() as $invalidInput) {
                    $flash   = $this->getInput('flashMessenger');
                    // $invalidInput->getName() . ': ' . implode(',',$invalidInput->getMessages()) . '<br/>';
                    $flash->addMessage('My message error');
                }
                $this->setFrontendVariable('errors', $flash->getMessages());
            }
        }
        
        $this->setTemplate('contatti/contatti.phtml');
        $this->setFrontendVariable('form', $form);

        return $this->getOutput();
    }
}
