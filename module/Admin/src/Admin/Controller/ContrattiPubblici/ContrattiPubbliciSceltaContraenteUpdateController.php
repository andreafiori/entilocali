<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteForm;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteFormInputFilter;
use ModelModule\Model\NullException;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteControllerHelper;
use Application\Controller\SetupAbstractController;

class ContrattiPubbliciSceltaContraenteUpdateController extends SetupAbstractController
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

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper = new SceltaContraenteControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);
            $helper->update($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contratti_pubblici_id,
                'message'       => "Aggiornata voce scelta contraente ".$inputFilter->nomeScelta,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Voce scelta contraente aggiornata',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna alla voce scelta contraente',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/contratti-pubblici-scelta-contraente-summary', array(
                    'lang' => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco voci scelta contraente",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contratti_pubblici_id,
                'message'       => "Errore aggiornamento voce scelta contraente ",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento voci scelta contraente',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco voci scelta contraente",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}