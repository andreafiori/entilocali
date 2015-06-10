<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteControllerHelper;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteForm;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteFormInputFilter;
use ModelModule\Model\NullException;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Log\LogWriter;
use Application\Controller\SetupAbstractController;

class ContrattiPubbliciSceltaContraenteInsertController extends SetupAbstractController
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

        $inputFilter = new SceltaContraenteFormInputFilter();

        $form = new SceltaContraenteForm();
        $form->setBindOnValidate(false);
        $form->setInputFilter( $inputFilter->getInputFilter() );
        $form->setData($post);

        $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();

        $helper = new SceltaContraenteControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper->setLoggedUser($userDetails);
            $lastInsertId = $helper->insert($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contratti_pubblici_id,
                'message'       => "Inserita nuova voce scelta contraente ".$inputFilter->nomeScelta,
                'type'          => 'info',
                'reference_id'  => $lastInsertId,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                => 'success',
                'messageTitle'               => 'Voce scelta contraente inserita correttamente',
                'messageText'                => 'I dati sono stati processati correttamente dal sistema',
                'showLinkResetFormAndShowIt' => 1,
                'backToSummaryLink'     => $this->url()->fromRoute('admin/contratti-pubblici-scelta-conctraente-summary', array(
                    'lang' => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco voci scelta contraente",
            ));

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $e) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contratti_pubblici_id,
                'message'       => "Errore inserimento nuova voce scelta contraente: ".$inputFilter->nomeScelta,
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento nuova sezione',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form di inserimento dati',
            ));
        }

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}