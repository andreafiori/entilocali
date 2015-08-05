<?php

namespace Admin\Controller\Sezioni;

use Application\Controller\SetupAbstractController;

class SezioniMigratorController extends SetupAbstractController
{
    /**
     * Migrate sezioni
     */
    public function indexAction()
    {
        /*
        $this->getRedbeanHelper()->executeQuery("TRUNCATE table zfcms_comuni_sottosezioni;
INSERT INTO zfcms_comuni_sottosezioni
(id, sezione_id, nome, immagine, url, posizione, attivo, profondita_a, profondita_da, is_ss)
(SELECT * FROM sottosezioni);");

        $records = $this->getRedbeanHelper()->getRecord("SELECT * FROM sottosezioni");

        foreach($records as $record) {
            $this->getRedbeanHelper()->executeQuery("UPDATE zfcms_comuni_sottosezioni SET
            slug = '".Slugifier::slugify($record['nome'])."',
            nome = '".htmlentities(addslashes($record['nome']))."' WHERE id = '".$record['id']."'
             ");
        }
        */
    }

    /**
     * Migrate sottosezioni
     */
    public function sottosezioniAction()
    {

    }
}