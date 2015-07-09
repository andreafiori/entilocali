<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciForm;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormInputFilter;
use ModelModule\Model\NullException;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Log\LogWriter;
use Application\Controller\SetupAbstractController;

/**
 * Contratti Pubblici Insert into db Controller
 */
class ContrattiPubbliciInsertController extends SetupAbstractController
{
    /**
     * @return \Zend\Http\Response
     */
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

        $helper = new ContrattiPubbliciControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper->setLoggedUser($userDetails);
            $lastInsertId = $helper->insert($inputFilter);

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'type'          => 'info',
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contratti_pubblici_id,
                'message'       => "Inserito il bando di gara ".$inputFilter->titolo,
                'reference_id'  => $lastInsertId,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                => 'success',
                'messageTitle'               => 'Bando di gara inserito correttamente',
                'messageText'                => 'I dati sono stati processati correttamente dal sistema',
                'showLinkResetFormAndShowIt' => 1,
                'backToSummaryLink'          => $this->url()->fromRoute('admin/contratti-pubblici-summary', array(
                    'lang' => 'it',
                )),
                'backToSummaryText'     => "Elenco bandi di gara e contratti",
                'attachmentsLink' => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => 'it',
                    'module'        => 'contratti-pubblici',
                    'referenceId'   => $lastInsertId,
                )),
                'insertAgainLabel'      => "Inserisci un altro bando di gara",
            ));

            $helper->getConnection()->commit();

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $e) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contratti_pubblici_id,
                'message'       => "Errore inserimento nuovo bando di gara: ".$inputFilter->titolo,
                'type'          => 'error',
				'description'   => "Si &egrave; verificato un errore nell'inserimento del nuovo bando di gara: ".$e->getMessage(),
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento nuovo bando di gara: '.$inputFilter->titolo,
                'messageText'           => 'Messaggio generato: '.$e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form di inserimento dati',
            ));
        }

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}