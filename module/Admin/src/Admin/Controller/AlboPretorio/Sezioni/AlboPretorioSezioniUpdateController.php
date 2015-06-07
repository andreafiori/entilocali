<?php

namespace Admin\Controller\AlboPretorio\Sezioni;

use ModelModule\Model\AlboPretorio\AlboPretorioSezioniControllerHelper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniForm;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniFormInputFilter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\NullException;
use Application\Controller\SetupAbstractController;

class AlboPretorioSezioniUpdateController extends SetupAbstractController
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

        $inputFilter = new AlboPretorioSezioniFormInputFilter();

        $form = new AlboPretorioSezioniForm();
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

            $helper = new AlboPretorioSezioniControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);
            $helper->update($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::albo_pretorio_id,
                'message'       => "Aggiornata sezione albo pretorio ".$inputFilter->nome. " ID: ".$inputFilter->id,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Sezione albo pretorio aggiornata correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna alla sezione',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/albo-pretorio-sezioni-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco sezioni",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::albo_pretorio_id,
                'message'       => "Errore aggiornamento sezione albo pretorio",
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