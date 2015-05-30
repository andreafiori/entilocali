<?php

namespace Admin\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiForm;
use ModelModule\Model\Contenuti\ContenutiFormInputFilter;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\NullException;

class ContenutiUpdateController extends SetupAbstractController
{
    /**
     * Update contenuti and render a message view
     *
     * @return \Zend\Http\Response
     */
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
            $helper->getConnection()->beginTransaction();
            $helper->update($inputFilter);
            $helper->getConnection()->commit();
            // TODO: insert or delete in home, update home field
            $helper->setLogWriter(new LogWriter($connection));
            $helper->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Aggiornato il contenuto ".$inputFilter->titolo. " ID: ".$inputFilter->id,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Contenuto aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al contenuto',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/contenuti-summary', array(
                    'lang'              => $this->params()->fromRoute('languageSelection'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                )),
                'backToSummaryText'     => "Elenco contenuti",
                'attachmentsLink'       => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => $this->params()->fromRoute('languageSelection'),
                    'module'        => 'contenuti',
                    'referenceId'   => $inputFilter->id,
                )),
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => isset($userDetails->id) ? $userDetails->id : null,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore aggiornamento contenuto ID: ".$inputFilter->id,
                'type'          => 'error',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento contenuto',
                'messageText'           => 'Messaggio generato: '.$e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al contenuto',
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}