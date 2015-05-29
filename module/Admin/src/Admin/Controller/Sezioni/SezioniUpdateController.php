<?php

namespace Admin\Controller\Sezioni;

use Admin\Model\Log\LogWriter;
use Admin\Model\Modules\ModulesContainer;
use Admin\Model\Sezioni\SezioniControllerHelper;
use Admin\Model\Sezioni\SezioniForm;
use Admin\Model\Sezioni\SezioniFormInputFilter;
use Application\Controller\SetupAbstractController;

class SezioniUpdateController extends SetupAbstractController
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

        $inputFilter = new SezioniFormInputFilter();

        $form = new SezioniForm();
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

            $helper = new SezioniControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->update($inputFilter);
            $helper->getConnection()->commit();
            // TODO: upload icon, delete old icon if old icon is set and its file exists
            $helper->setLogWriter(new LogWriter($connection));
            $helper->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Aggiornata sezione ".$inputFilter->nome. " ID: ".$inputFilter->id,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Sezione aggiornata correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna alla sezione',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/sezioni-summary', array(
                    'lang'              => $this->params()->fromRoute('languageSelection'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                )),
                'backToSummaryText'     => "Elenco sezioni",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore aggiornamento sezione ID: ".$inputFilter->id,
                'type'          => 'error',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento sezione',
                'messageText'           => 'Messaggio generato: '.$e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna alla sezione',
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}