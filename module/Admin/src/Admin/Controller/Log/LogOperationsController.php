<?php

namespace Admin\Controller\Log;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;

class LogOperationsController extends SetupAbstractController
{
    /**
     * Delete all logs and redirect to summary
     */
    public function deleteallAction()
    {
        if ($this->getRequest()->isPost()) {
            /*
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $connection = $em->getConnection();

            $dbPlatform = $connection->getDatabasePlatform();

            $connection->beginTransaction();
            try {

                $connection->query('SET FOREIGN_KEY_CHECKS=0');

                $q = $dbPlatform->getTruncateTableSql(DbTableContainer::logs);

                $connection->executeUpdate($q);
                $connection->query('SET FOREIGN_KEY_CHECKS=1');
                $connection->commit();

            } catch (\Exception $e) {
                $connection->rollback();
            }
            */
        }
    }

    /**
     * TODO: Delete single log (after a verified post)
     */
    public function deletesingle()
    {

    }

    /**
     * TODO: set search session and redirect to summary
     */
    public function setsearchsessionAction()
    {

    }
}