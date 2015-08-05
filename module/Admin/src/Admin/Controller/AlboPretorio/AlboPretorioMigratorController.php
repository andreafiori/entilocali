<?php

namespace Admin\Controller\AlboPretorio;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\AlboPretorio\AlboPretorioMigrator;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;

class AlboPretorioMigratorController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $configFromServiceLocator = $this->getServiceLocator()->get('config');
        $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];

        $migrator = new AlboPretorioMigrator($connectionParams);
        $migrator->trucateAlboPretorioAtti();



        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Migrate attachment albo pretorio
     */
    public function attachmentsAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $configFromServiceLocator = $this->getServiceLocator()->get('config');
        $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];

        $migrator = new AlboPretorioMigrator($connectionParams);
        $attachmentRecords = $migrator->recoverAllegati();

        try {

            if (empty($attachmentRecords) or !is_array($attachmentRecords)) {
               throw new NullException($attachmentRecords);
            }

            $migrator->migrateAttachments($attachmentRecords);

            $this->layout()->setVariables(array(
                'configurations'                => $configurations,
                'templatePartial'               => 'message.phtml',
                'showBreadCrumb'                => 1,
                'formBreadCrumbCategory'        => 'Migrazione dati',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/migrazione', array('lang' => 'it')),
                'formBreadCrumbTitle'           => 'Allegati albo pretorio',
                'messageType'                   => 'success',
                'messageTitle'                  => 'Allegati albo pretorio estratti e migrati correttamente',
                'messageText'                   => 'Controlla la cartella con i files estratti',
            ));

        } catch(NullException $e) {
            $logWriter = new LogWriter($em->getConnection());
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::albo_pretorio_id,
                'message'       => "Errore migrazione allegati albo pretorio",
                'description'   => 'Errore verificato: '.$e->getMessage(),
                'type'          => 'error',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'configurations'                => $configurations,
                'templatePartial'               => 'message.phtml',
                'showBreadCrumb'                => 1,
                'formBreadCrumbCategory'        => 'Migrazione dati',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/migrazione', array('lang' => 'it')),
                'formBreadCrumbTitle'           => 'Allegati albo pretorio ',
                'messageType'                   => 'danger',
                'messageTitle'                  => "Errore migrazione allegati albo pretorio ",
                'messageText'                   => 'Errore verificato: '.$e->getMessage(),
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Migrate sezioni albo pretorio
     */
    public function sezioniAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $configFromServiceLocator = $this->getServiceLocator()->get('config');
        $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];

        $migrator = new AlboPretorioMigrator($connectionParams);

        $this->layout()->setVariables(array(
            'configurations'                => $configurations,
            'showBreadCrumb'                => 1,
            'formBreadCrumbCategory'        => 'Migrazione dati',
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/migrazione', array('lang' => 'it')),
            'formBreadCrumbTitle'           => 'Sezioni albo pretorio ',
            'templatePartial'               => 'message.phtml',
            'messageType'                   => 'success',
            'messageTitle'                  => 'Sezioni albo pretorio  migrate correttamente',
            'messageText'                   => 'Controlla le sezioni estratte',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}