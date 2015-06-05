<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliForm;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliFormInputFilter;
use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\NullException;
use Application\Controller\SetupAbstractController;

class AlboPretorioUpdateController extends SetupAbstractController
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

        $inputFilter = new AlboPretorioArticoliFormInputFilter();

        $form = new AlboPretorioArticoliForm();
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

            $helper = new AlboPretorioControllerHelper();
            $helper->setConnection($connection);
            $helper->setLoggedUser($userDetails);
            $helper->getConnection()->beginTransaction();
            $helper->update($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Aggiornato atto albo pretorio ".$inputFilter->titolo. " ID: ".$inputFilter->id,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Atto albo pretorio aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco atti albo pretorio",
                'backToSummaryLink'     => $this->url()->fromRoute('admin/albo-pretorio-summary', array(
                    'lang' => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco atti albo pretorio",
                'attachmentsLink' => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => $this->params()->fromRoute('lang'),
                    'module'        => 'albo-pretorio',
                    'referenceId'   => $inputFilter->id,
                )),
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::albo_pretorio_id,
                'message'       => "Errore aggiornamento atto albo pretorio",
                'type'          => 'error',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento atto albo pretorio',
                'messageText'           => 'Messaggio generato: '.$e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco atti atto albo pretorio",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}