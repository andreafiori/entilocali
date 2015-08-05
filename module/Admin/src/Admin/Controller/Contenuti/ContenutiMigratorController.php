<?php

namespace Admin\Controller\Contenuti;

use Application\Controller\SetupAbstractController;;
use ModelModule\Model\Contenuti\ContenutiMigrator;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\Slugifier;

class ContenutiMigratorController extends SetupAbstractController
{
    /**
     * Migrate contenuti
     */
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $configFromServiceLocator = $this->getServiceLocator()->get('config');
        $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];

        $migrator = new ContenutiMigrator($connectionParams);
        $migrator->executeQuery("TRUNCATE table zfcms_comuni_contenuti");

        try {

            $migrator->checkRedBeanQueryResult(
                $migrator->executeQuery("INSERT INTO zfcms_comuni_contenuti (id, sottosezione_id, anno, numero, titolo, sommario, testo, data_inserimento, data_scadenza, data_invio_regione, attivo, home, evidenza, utente_id, rss, pub_albo_comune, data_rettifica, path, tabella, check_atti, annoammtrasp) ( SELECT * FROM contenuti ); ")
            );

            $records = $migrator->getRecords("SELECT * FROM zfcms_comuni_contenuti WHERE titolo != '' ");

            if (!empty($records)) {
                foreach($records as $record) {
                    $migrator->executeQuery("UPDATE zfcms_comuni_contenuti SET  slug = '".Slugifier::slugify($record['titolo'])."',
             titolo = '".htmlentities(addslashes($record['titolo']))."' WHERE id = '".$record['id']."' ");
                }
            }

            $logWriter = new LogWriter($em->getConnection());
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Migrazione contenuti",
                'description'   => 'Migrazione contenuti effettuata correttamente',
                'type'          => 'info',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'configurations'    => $configurations,
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'success',
                'messageTitle'      => 'Migrazione contenuti effettuata con successo',
                'messageText'       => 'Controllare i contenuti importati',
            ));

        } catch(NullException $e) {
            echo $e->getMessage(); exit;
        }

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Migrate contenuti attachments files
     */
    public function attachmentsAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $configFromServiceLocator = $this->getServiceLocator()->get('config');
        $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];

        $contenutiMigrator = new ContenutiMigrator($connectionParams);
        $attachmentRecords = $contenutiMigrator->recoverAllegati();

        try {

            $contenutiMigrator->migrateAttachments($attachmentRecords);

            $this->layout()->setVariables(array(
                'configurations'    => $configurations,
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'success',
                'messageTitle'      => 'Migrazione files effettuata con successo',
                'messageText'       => 'Controlla la cartella contenuti',
            ));

            $logWriter = new LogWriter($em->getConnection());
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Migrazione allegati contenuti",
                'description'   => 'Migrazione allegati contenuti effettuata correttamente',
                'type'          => 'info',
                'backend'       => 1,
            ));

        } catch(NullException $e) {
            $logWriter = new LogWriter($em->getConnection());
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore migrazione allegati contenuti",
                'description'   => 'Errore verificato: '.$e->getMessage(),
                'type'          => 'error',
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'configurations'    => $configurations,
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'danger',
                'messageTitle'      => "Errore migrazione allegati contenuti",
                'messageText'       => 'Errore verificato: '.$e->getMessage(),
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}