<?php

namespace ModelModule\Model\Contenuti;

use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\Migrazione\MigratorAbstract;
use ModelModule\Model\Slugifier;

class ContenutiMigrator extends MigratorAbstract
{
    public function migrate()
    {
        $this->assertRedbeanHelper();

        $contentsMigrated = $this->getRedbeanHelper()->executeQuery("TRUNCATE table zfcms_comuni_contenuti;
        INSERT INTO zfcms_comuni_contenuti
        (id, sottosezione_id, anno, numero, titolo, sommario, testo,
        data_inserimento, data_scadenza, data_invio_regione, attivo, home, evidenza, utente_id,
        rss, pub_albo_comune, data_rettifica, path, tabella, check_atti, annoammtrasp)
        (SELECT * FROM contenuti);");

        // Fix contents
        $records = $this->getRedbeanHelper()->getRecord("SELECT * FROM zfcms_comuni_contenuti WHERE titolo!='' ");

        foreach($records as $record) {
            $this->getRedbeanHelper()->executeQuery("UPDATE zfcms_comuni_contenuti SET
            slug = '".Slugifier::slugify($record['titolo'])."',
            titolo = '".htmlentities(addslashes($record['titolo']))."' WHERE id = '".$record['id']."'
             ");
        }
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
