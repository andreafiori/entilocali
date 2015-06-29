<?php

namespace Auth\Controller;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\SetupAbstractControllerHelper;
use ModelModule\Model\Users\RecoverPasswordForm;
use ModelModule\Model\Users\RecoverPasswordFormInputFilter;
use ModelModule\Model\Users\UsersControllerHelper;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
use Zend\Mail;

/**
 * TODO: form recover password, validate form, send email with request, confirm received request selecting confirm code
 */
class RecoverPasswordController extends SetupAbstractController
{
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');

        $templateBackend = $appServiceLoader->recoverServiceKey('configurations', 'template_backend');

        $request = $this->getRequest();

        $helper = new SetupAbstractControllerHelper();
        $helper->setConfigurations($configurations);
        $helper->setRequest($request);
        $helper->setupZf2appDir();
        $helper->setupAppDirRelativePath();

        $form = new RecoverPasswordForm();
        $form->addSubmitButton();

        $this->layout()->setVariables(
            array(
                'configurations'        => $configurations,
                'publicDirRelativePath' => $helper->getAppDirRelativePath().'/public',
                'form'                  => $form,
            )
        );

        return $this->layout('backend/templates/'.$templateBackend.'recover-password.phtml');
    }

    /**
     * Search POSTED user email, send email with request to regenerate password or choose a new one
     *
     * @return mixed
     */
    public function sendrecoverrequestAction()
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->redirect()->toRoute('main');
        }

        $post = $request->getPost()->toArray();

        $inputFilter = new RecoverPasswordFormInputFilter();

        $form = new RecoverPasswordForm();
        $form->setInputFilter($inputFilter->getInputFilter());
        $form->setData($post);

        $helper = new UsersControllerHelper();
        $helper->setConnection($em->getConnection());

        if ($form->isValid()) {
            $userRecords = $helper->recoverWrapperRecords(
                new UsersGetterWrapper(new UsersGetter($em)),
                array('emailUsername' => $post['email'], 'limit' => 1)
            );

            if (!empty($userRecords) and count($userRecords)==1) {

                $confirmCode = md5(uniqid());

                $helper->updateConfirmCode($userRecords[0]['id'], $confirmCode);

                $uri = $request->getUri();
                $basePath = sprintf('%s://%s%s', $uri->getScheme(), $uri->getHost(), '');
                $linkRecoverPasswordForm = $basePath.$this->url()->fromRoute('recover-password', array(
                    'action'        => 'formchangepassword',
                    'confirmcode'   => $confirmCode
                ));

                $appServiceLoader = $this->recoverAppServiceLoader(1);

                $configurations = $appServiceLoader->recoverService('configurations');

                $noReplayMail = isset($configurations['mailnoreply']) ? $configurations['mailnoreply'] : 'noreply@thisemail.com';

                $message = $configurations['sitename']."\n\n";
                $message .= "E' stata registrata una richiesta di recupero password per il sito in oggetto.\n\n";
                $message .= 'Per scegliere una nuova password, <a href="'.$linkRecoverPasswordForm.'">clicca qui</a>'."\n\n";
                $message .= "Se non vedi il link, conferma la richiesta copiando e incollando il link sotto riportato sul tuo browser:\n\n";
                $message .= $linkRecoverPasswordForm."\n\n";
                $message .= 'Non rispondere a questo messaggio'."\n\n";
                $message .= date("Y").' '.$configurations['sitename'];

                /* Send email with link for password recover */
                $mail = new Mail\Message();
                $mail->setBody($message);
                $mail->setFrom($noReplayMail, $configurations['sitename']);
                $mail->addTo($userRecords[0]['email'], $userRecords[0]['name'].' '.$userRecords[0]['surname']);
                $mail->setSubject('Richiesta recupero password ', $configurations['sitename']);

                $transport = new Mail\Transport\Sendmail($userRecords[0]['email']);
                $transport->send($mail);

                /* Redirect to another page with OK message to avoid double POSTs */
                return $this->redirect()->toRoute('recover-password', array(
                    'action'        => 'showconfirm',
                    'confirmcode'   => 'passwordRequestSentOk'
                ));
            } else {
                // User not found, invalid request...
            }
        } else {
            // The form is not valid, it can redirect to a confirm message page
        }

        return $this->redirect()->toRoute('main');
    }

    /**
     * TODO: Check referer, show message
     */
    public function showconfirmAction()
    {

    }

    /**
     * TODO: receive a confirm code via get from the email link. Search confirm code, show form to regenerate password or choose a new one
     */
    public function formchangepasswordAction()
    {

    }
}