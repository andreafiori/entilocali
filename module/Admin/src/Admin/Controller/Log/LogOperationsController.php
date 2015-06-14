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

            /**
             * @var \Doctrine\ORM\EntityManager $em
             */
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            /**
             * @var \Doctrine\DBAL\Connection $connection
             */
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

        }
    }

    /**
     * TODO: Delete single log
     */
    public function deletesingleAction()
    {

    }

    /**
     * TODO: set search session and redirect to summary
     */
    public function setsearchsessionAction()
    {

    }
}