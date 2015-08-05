<?php

namespace Admin\Controller\StatoCivile;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\StatoCivile\StatoCivileMigrator;

class StatoCivileMigratorController extends SetupAbstractController
{
    /**
     * Atti stato civile migration
     */
    public function indexAction()
    {

    }

    /**
     * Stato civile attachment files migration
     */
    public function attachmentsAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $configFromServiceLocator = $this->getServiceLocator()->get('config');
        $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];

        $migrator = new StatoCivileMigrator($connectionParams);
        $attachmentRecords = $migrator->recoverAllegati();

        try {

            $migrator->migrateAttachments($attachmentRecords);

            $this->layout()->setVariables(array(
                'configurations'                => $configurations,
                'templatePartial'               => 'message.phtml',
                'showBreadCrumb'                => 1,
                'formBreadCrumbCategory'        => 'Migrazione dati',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/migrazione', array('lang' => 'it')),
                'formBreadCrumbTitle'           => 'Allegati stato civile',
                'messageType'                   => 'success',
                'messageTitle'                  => 'Allegati stato civile estratti e migrati correttamente',
                'messageText'                   => 'Controlla la cartella con i files estratti',
            ));

        } catch(NullException $e) {
            $logWriter = new LogWriter($em->getConnection());
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::stato_civile_id,
                'message'       => "Errore migrazione allegati stato civile",
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
                'formBreadCrumbTitle'           => 'Allegati stato civile',
                'messageType'                   => 'danger',
                'messageTitle'                  => "Errore migrazione allegati stato civile",
                'messageText'                   => 'Errore verificato: '.$e->getMessage(),
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Migration sezioni stato civile
     */
    public function sezioniAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $configFromServiceLocator = $this->getServiceLocator()->get('config');
        $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];

        $migrator = new StatoCivileMigrator($connectionParams);

        $this->layout()->setVariables(array(
            'configurations'                => $configurations,
            'showBreadCrumb'                => 1,
            'formBreadCrumbCategory'        => 'Migrazione dati',
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/migrazione', array('lang' => 'it')),
            'formBreadCrumbTitle'           => 'Sezioni stato civile',
            'templatePartial'               => 'message.phtml',
            'messageType'                   => 'success',
            'messageTitle'                  => 'Sezioni stato civile migrate correttamente',
            'messageText'                   => 'Controlla le sezioni estratte',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}
