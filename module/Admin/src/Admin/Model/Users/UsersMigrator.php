<?php

namespace Admin\Model\Users;

use Admin\Model\Migrazione\MigratorAbstract;

/**
 * @author Andrea Fiori
 * @since  21 February 2015
 */
class UsersMigrator extends MigratorAbstract
{
    public function migrate()
    {
        $this->assertRedbeanHelper();

        return $this->getRedbeanHelper()->executeQuery("TRUNCATE table zfcms_comuni_contenuti;
        INSERT INTO zfcms_comuni_contenuti
        (id, sottosezione_id, anno, numero, titolo, sommario, testo,
        data_inserimento, data_scadenza, data_invio_regione, attivo, home, evidenza, utente_id,
        rss, pub_albo_comune, data_rettifica, path, tabella, check_atti, annoammtrasp)
        (SELECT * FROM contenuti);");
    }

    public function log()
    {
        $this->assertLogWriter();

        $this->getLogWriter()->writeLog(array(
            'user_id'   => $this->getUserDetailsKey('id'),
            'module_id' => 2,
            'message'   => $this->getUserDetailsKey('name').' '.$this->getUserDetailsKey('surname')." ha effettuato la <strong>migrazione contenuti</strong> dal database vecchio CMS ",
            'type'      => 'info',
            'backend'   => 1,
        ));
    }
}