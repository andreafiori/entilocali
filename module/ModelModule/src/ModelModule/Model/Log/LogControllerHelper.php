<?php

namespace ModelModule\Model\Log;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;

class LogControllerHelper extends ControllerHelperAbstract
{
    /**
     * Delete all logs from db
     *
     * @return bool
     */
    public function deleteAll()
    {
        $this->assertConnection();

        $dbPlatform = $this->getConnection()->getDatabasePlatform();

        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
        $this->getConnection()->executeUpdate($dbPlatform->getTruncateTableSql(DbTableContainer::logs));
        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');

        return true;
    }
}
