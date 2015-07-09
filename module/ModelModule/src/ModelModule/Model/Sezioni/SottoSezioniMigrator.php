<?php

namespace ModelModule\Model\Sezioni;

use ModelModule\Model\Migrazione\MigratorAbstract;
use ModelModule\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  21 February 2015
 */
class SottoSezioniMigrator extends MigratorAbstract
{
    public function migrate()
    {
        $this->assertRedbeanHelper();

        $this->getRedbeanHelper()->executeQuery("TRUNCATE table zfcms_comuni_sottosezioni;
INSERT INTO zfcms_comuni_sottosezioni
(id, sezione_id, nome, immagine, url, posizione, attivo, profondita_a, profondita_da, is_ss)
(SELECT * FROM sottosezioni);");

        // Fix contents
        $records = $this->getRedbeanHelper()->getRecord("SELECT * FROM sottosezioni");

        foreach($records as $record) {
            $this->getRedbeanHelper()->executeQuery("UPDATE zfcms_comuni_sottosezioni SET
            slug = '".Slugifier::slugify($record['nome'])."',
            nome = '".htmlentities(addslashes($record['nome']))."' WHERE id = '".$record['id']."'
             ");
        }
    }

    public function log()
    {
        $this->assertLogWriter();

        $this->getLogWriter()->writeLog(array(
            'user_id'   => $this->getUserDetailsKey('id'),
            'module_id' => 2,
            'message'   => $this->getUserDetailsKey('name').' '.$this->getUserDetailsKey('surname')." ha effettuato la <strong>migrazione sezioni</strong> dal database vecchio CMS ",
            'type'      => 'info',
            'backend'   => 1,
        ));
    }
}