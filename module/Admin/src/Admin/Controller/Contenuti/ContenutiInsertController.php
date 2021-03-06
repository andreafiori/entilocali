<?php

namespace Admin\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiForm;
use ModelModule\Model\Contenuti\ContenutiFormInputFilter;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use Application\Controller\SetupAbstractController;

/**
 * TODO: insert in home, update home field if home is selected
 *
 * Insert a new Contenuto into db and log operation
 */
class ContenutiInsertController extends SetupAbstractController
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

        $modulename = $this->params()->fromRoute('modulename');

        $inputFilter = new ContenutiFormInputFilter();

        $form = new ContenutiForm();
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

            $helper = new ContenutiControllerHelper();
            $helper->setConnection($connection);
            $helper->setLoggedUser($userDetails);
            $helper->getConnection()->beginTransaction();
            $lastInsertId = $helper->insert($inputFilter);

            $helper->setLogWriter(new LogWriter($connection));
            $helper->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Inserito nuovo contenuto \ articolo ".$inputFilter->titolo,
                'type'          => 'info',
                'reference_id'  => $lastInsertId, 'backend' => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                   => 'success',
                'messageTitle'                  => 'Articolo inserito correttamente',
                'messageText'                   => 'I dati sono stati processati correttamente dal sistema',
                'showLinkResetFormAndShowIt'    => 1,
                'backToSummaryLink' => $this->url()->fromRoute('admin/contenuti-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                    'modulename'        => $modulename,
                )),
                'backToSummaryText'             => "Elenco contenuti",
                'insertAgainLabel'              => "Inserisci un altro articolo \ contenuto",
                'attachmentsLink' => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => $this->params()->fromRoute('languageSelection'),
                    'module'        => $modulename,
                    'referenceId'   => $lastInsertId,
                )),
            ));

            $helper->getConnection()->commit();

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore inserimento nuovo contenuto \ articolo: ".$inputFilter->titolo,
				'description'   => $e->getMessage()."; Titolo: ".$inputFilter->titolo." Testo: ".$inputFilter->testo.' Sottosezione: '.$inputFilter->sottosezione,
                'type'          => 'error',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento contenuto \ articolo',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form di inserimento dati',
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}