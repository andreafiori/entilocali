<?php

namespace ModelModule\Model\Users;

use ModelModule\Model\Migrazione\MigratorAbstract;

/**
 * TODO: users migration
 *
 * @author Andrea Fiori
 * @since  21 February 2015
 */
class UsersMigrator extends MigratorAbstract
{
    public function migrate()
    {
        $this->assertRedbeanHelper();

        return $this->getRedbeanHelper()->executeQuery("TRUNCATE table zfcms_users;
INSERT INTO zfcms_users (id, name, email, username, password, livello)
(SELECT id, nome, mail, username, password, settore, role_id FROM utenti);");
    }

    public function log()
    {
        $this->assertLogWriter();

        $this->getLogWriter()->writeLog(array(
            'user_id'   => $this->getUserDetailsKey('id'),
            'module_id' => 2,
            'message'   => $this->getUserDetailsKey('name').' '.$this->getUserDetailsKey('surname')." ha effettuato la <strong>migrazione utenti</strong> dal database vecchio CMS ",
            'type'      => 'info',
            'backend'   => 1,
        ));
    }
}