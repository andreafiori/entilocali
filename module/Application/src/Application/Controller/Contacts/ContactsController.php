<?php

namespace Application\Controller\Contacts;

use Admin\Controller\Contacts\ContactsControllerHelper;
use Zend\Mail;
use ModelModule\Model\Contacts\ContactsFormInputFilter;
use ModelModule\Model\Contacts\ContactsForm;
use Application\Controller\SetupAbstractController;

/**
 * Contact form controller
 */
class ContactsController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new ContactsForm();
        /* $form->addCaptcha(); */
        $form->addSubmitButton();

        $this->layout()->setVariables(array(
            'form'              => $form,
            'templatePartial'   => 'contatti/contatti.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Send email to contacts, insert message into db, log operation
     */
    public function sendAction()
    {
        $form = new ContactsForm();

        $request  = $this->getRequest();

        if ( $request->isPost() ) {

            $mainLayout = $this->initializeFrontendWebsite();

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $inputFilter = new ContactsFormInputFilter();

            $form->setInputFilter($inputFilter->getInputFilter());

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $inputFilter->exchangeArray($form->getData());

                $formData = $request->getPost();

                $configurations = $this->layout()->getVariable('configurations');

                $mail = new Mail\Message();
                $mail->setFrom($configurations['emailnoreply'], $formData->nome.' '.$formData->cognome);
                $mail->addTo($configurations['emailcontact'], $configurations['sitename']);
                $mail->setSubject('Nuovo messaggio dal sito '.$configurations['sitename']);
                $mail->setBody("Nome e cognome: \n ".$formData->nome." ".$formData->cognome." Email: ".$formData->email."\n Messaggio: ".$formData->messaggio);

                $transport = new Mail\Transport\Sendmail();
                $transport->send($mail);

                $helper = new ContactsControllerHelper();
                $helper->setConnection($em->getConnection());
                $helper->insert($inputFilter);

                $this->layout()->setVariables(array(
                    'configuraitions'   => $configurations,
                    'homepage'          => !empty($homePageElements) ? $homePageElements : null,
                    'templatePartial'   => 'contatti/ok.phtml',
                ));

                $this->layout()->setTemplate($mainLayout);

            } else {

                foreach ($form->getInputFilter()->getInvalidInput() as $invalidInput) {
                    var_dump($form->getMessages());
                }
                exit;
            }
        }
    }
}