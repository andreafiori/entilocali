<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciForm;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormInputFilter;
use ModelModule\Model\NullException;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Log\LogWriter;
use Application\Controller\SetupAbstractController;

class ContrattiPubbliciUpdateController extends SetupAbstractController
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

        $inputFilter = new ContrattiPubbliciFormInputFilter();

        $form = new ContrattiPubbliciForm();
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

            $helper = new ContrattiPubbliciControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->update($inputFilter);
            $helper->getConnection()->commit();
            $helper->setLogWriter(new LogWriter($connection));
            $helper->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Aggiornato il bando di gara ".$inputFilter->titolo,
                'reference_id'  => $userDetails->id,
                'type'          => 'info',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Bando di gara aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/contratti-pubblici-summary', array(
                    'lang' => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco settori utente",
                'attachmentsLink'       => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => $this->params()->fromRoute('lang'),
                    'module'        => 'contratti-pubblici',
                    'referenceId'   => $inputFilter->id,
                )),
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore nell'aggiornamento contratto pubblico ".$inputFilter->titolo,
                'description'   => $e->getMessage(),
                'reference_id'  => $inputFilter->id,
                'type'          => 'error',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento contratto pubblico',
                'messageText'           => $e->getMessage(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna ai dati del bando di gara",
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
            ));
        }

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}