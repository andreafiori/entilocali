<?php

namespace Admin\Controller\Posts;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\Posts\PostsCategoriesControllerHelper;
use ModelModule\Model\Posts\PostsCategoriesForm;
use ModelModule\Model\Posts\PostsCategoriesFormInputFilter;

class PostsCategoriesInsertController extends SetupAbstractController
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

        $inputFilter = new PostsCategoriesFormInputFilter();

        $form = new PostsCategoriesForm();
        $form->setBindOnValidate(false);
        $form->setInputFilter( $inputFilter->getInputFilter() );
        $form->setData($post);

        $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();

        $helper = new PostsCategoriesControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper->setLoggedUser($userDetails);
            $inputFilter->moduleId = ModulesContainer::recoverIdFromModuleCode($this->params()->fromRoute('modulename'));
            $languageRecords = $helper->recoverWrapperRecords(
                new LanguagesGetterWrapper(new LanguagesGetter($em)),
                array(
                    'abbrev1' => $this->params()->fromRoute('languageSelection'),
                    'fields' => 'languages.id'
                )
            );
            $helper->checkRecords($languageRecords,'Nessun dato relativo alle lingue');
            $inputFilter->languageId = $languageRecords[0]['id'];
            $inputFilter->moduleId = ModulesContainer::recoverIdFromModuleCode($this->params()->fromRoute('formtype'));
            $helper->insert($inputFilter);
            $lastInsertId = $helper->getConnection()->lastInsertId();
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::blogs,
                'message'       => "Inserita nuova categoria ".$this->params()->fromRoute('formtype').' '.$inputFilter->name,
                'type'          => 'info',
                'reference_id'  => $lastInsertId,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                => 'success',
                'messageTitle'               => 'Categoria inserita correttamente',
                'messageText'                => 'I dati sono stati processati correttamente dal sistema',
                'showLinkResetFormAndShowIt' => 1,
                'backToSummaryLink'     => $this->url()->fromRoute('admin/posts-categories-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                    'moduleCode'        => $this->params()->fromRoute('formtype'),
                )),
                'backToSummaryText'     => "Elenco categorie",
            ));

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $e) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore inserimento nuova categoria: ".$inputFilter->name,
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento nuova categoria',
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