<?php

namespace Admin\Controller\StatoCivile\Sezioni;

use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniControllerHelper;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniForm;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniFormInputFilter;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use Application\Controller\SetupAbstractController;

class StatoCivileSezioniUpdateController extends SetupAbstractController
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

        $inputFilter = new StatoCivileSezioniFormInputFilter();

        $form = new StatoCivileSezioniForm();
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

            $helper = new StatoCivileSezioniControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);
            $helper->update($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'type'          => 'info',
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Aggiornata sezione stato civile <strong>".$inputFilter->nome. "</strong>",
                'reference_id'  => $inputFilter->id,
                'user_id'       => $userDetails->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Sezione stato civile aggiornata correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna alla sezione',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/stato-civile-sezioni-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco sezioni",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore aggiornamento sezione stato civile ".$inputFilter->nome,
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento sezione stato civile '.$inputFilter->nome,
                'messageText'           => 'Messaggio generato: '.$e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form dati sezione',
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}