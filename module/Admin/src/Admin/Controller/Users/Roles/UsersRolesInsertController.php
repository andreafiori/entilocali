<?php

namespace Admin\Controller\Users\Roles;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\Users\Roles\UsersRolesControllerHelper;
use ModelModule\Model\Users\Roles\UsersRolesForm;
use ModelModule\Model\Users\Roles\UsersRolesFormInputFilter;
use ModelModule\Model\Users\Roles\UsersRolesGetter;
use ModelModule\Model\Users\Roles\UsersRolesGetterWrapper;

/**
 * User Role insert controller
 */
class UsersRolesInsertController extends SetupAbstractController
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

        $inputFilter = new UsersRolesFormInputFilter();

        $form = new UsersRolesForm();
        $form->setBindOnValidate(false);
        $form->setInputFilter( $inputFilter->getInputFilter() );
        $form->setData($post);

        $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();

        $helper = new UsersRolesControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper->setLoggedUser($userDetails);

            $userRoleRecord = $helper->recoverWrapperRecords(
                new UsersRolesGetterWrapper(new UsersRolesGetter($em)),
                array('name' => $inputFilter->name)
            );
            if (!empty($userRoleRecord)) {
                throw new NullException("Il nome ruolo inserito &egrave; gi&agrave; presente in archivio");
            }

            $lastInsertId = $helper->insert($inputFilter);

            if ($inputFilter->adminAccess==1 and empty($inputFilter->permissions)) {
                throw new NullException("Aggiungere almeno un permesso al ruolo");
            }

            if (!empty($inputFilter->permissions)) {
                foreach($inputFilter->permissions as $key => $value) {
                    $helper->insertPermissionRelation($lastInsertId, $value);
                }
            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Inserito nuovo ruolo utente ".$inputFilter->name,
                'type'          => 'info',
                'reference_id'  => $lastInsertId,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                => 'success',
                'messageTitle'               => 'Ruolo utente inserito correttamente',
                'messageText'                => 'I dati sono stati processati correttamente dal sistema',
                'showLinkResetFormAndShowIt' => 1,
                'backToSummaryLink'     => $this->url()->fromRoute('admin/users-roles-summary', array(
                    'lang' => $this->params()->fromRoute('lang'),
                )),
                'backToSummaryText'     => "Elenco ruoli",
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
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore inserimento nuovo ruolo utente: ".$inputFilter->name,
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento nuovo ruolo utente',
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