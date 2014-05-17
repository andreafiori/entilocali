<?php

namespace Application\Model\Newsletter;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * TODO: make signin or delete, send confirm email redirect to a response
 * 
 * @author Andrea Fiori
 * @since  16 May 2014
 */
class NewsletterFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $request  = $this->getInput('request');

        if ( $request->isPost() ) {
            /*
            $form = new NewsletterForm();
            $form->setInputFilter( new ContattiFormValidator() );
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                $redirect = $this->getInput('redirect');
                $formData = $request->getPost();

                $configurations = $this->getInput('configurations', 1);

                $transport = new Mail\Transport\Sendmail();

                $template = 'newsletter/response.phtml';

            } else {
                $flashMessenger = $this->getInput('flashMessenger');
                foreach ($form->getInputFilter()->getInvalidInput() as $invalidInput) {
                    $flashMessenger->addMessage('My message error');
                }
                $this->setVariable('messages', $flashMessenger->getMessages());
            }
            */
        } else {
            $redirect = $this->getInput('redirect');
            $redirect->toRoute('home');
            return;
        }
        
        $this->setVariable('response', 0);
        $this->setTemplate('newsletter/response.phtml');
    }
}
