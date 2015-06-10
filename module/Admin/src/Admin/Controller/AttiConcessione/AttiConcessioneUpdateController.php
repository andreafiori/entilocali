<?php

namespace Admin\Controller\AttiConcessione;

use ModelModule\Model\AttiConcessione\AttiConcessioneControllerHelper;
use ModelModule\Model\AttiConcessione\AttiConcessioneForm;
use ModelModule\Model\AttiConcessione\AttiConcessioneFormInputFilter;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use Application\Controller\SetupAbstractController;

class AttiConcessioneUpdateController extends SetupAbstractController
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

        $inputFilter = new AttiConcessioneFormInputFilter();

        $form = new AttiConcessioneForm();
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

            $helper = new AttiConcessioneControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->update($inputFilter);
            $helper->getConnection()->commit();
			
            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::atti_concessione,
                'message'       => "Aggiornato atto di concessione ".$inputFilter->titolo,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Atto di concessione aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna alla modifica atto',
                'backToSummaryLink'     => $this->url()->fromRoute('admin/atti-concessione-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                    'modulename'        => $this->params()->fromRoute('modulename'),
                )),
                'backToSummaryText'     => "Elenco atti",
                'attachmentsLink' => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => $this->params()->fromRoute('lang'),
                    'module'        => 'atti-concessione',
                    'referenceId'   => $inputFilter->id,
                )),
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::atti_concessione,
                'message'       => "Errore aggiornamento atto concessione",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento atto di concessione',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'atto di concessione",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}