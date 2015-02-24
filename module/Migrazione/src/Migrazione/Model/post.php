<?php

require_once("setup_database.php");

/**
 * @since  03 July 2014
 * @author Andrea Fiori
 */
function showAlertMessage($title, $message, $type = 'danger')
{
?>
<div class="alert alert-<?php echo $type ?>">
    <h1><?php echo $title ?></h1>
    <p><?php echo $message ?></p>
</div>
<?php
}

/**
 * @since  04 July 2014
 * @author Andrea Fiori
 */
function getRecord($q)
{
    try {
        return R::getAll($q);
    }  catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function executeQuery($q)
{
    R::begin();
    try {
        $result = R::exec($q);
        R::commit();
        return $result;
    }  catch (Exception $ex) {
        R::rollback();
        return $ex->getMessage();
    }
}

function executeMultipleQuery(array $q)
{
    if ( is_array($q) ) {
        foreach ($q as $query) {
            R::begin();
            try {
                R::exec($q);
                R::commit();
            } catch (Exception $ex) {
                R::rollback();
                return false;
            }
        }
    }
}

executeQuery("SET foreign_key_checks = 0");

/* Execute import operations */
switch($_GET['op'])
{
    default:
        ?>
        <div class="alert alert-danger">
            <h1>Errore</h1>
            <p>Richiesta non valida</p>
        </div>
        <?php
    break;

    case("config"):
        try {
            $result = getRecord("SELECT * FROM config");
            if ( is_array($result) ) {
                
                $res1 = executeQuery("INSERT INTO zfcms_config (name, value) VALUES ('sitename', '".$result[0]['sitename']."') ");
                
                $res2 = executeQuery("INSERT INTO zfcms_config (name, value) VALUES ('keywords', '".$result[0]['keywords']."') ");
                
                showAlertMessage('Operazione completata', 'Configurazioni sito importate correttamente', 'success');                
                
            } else {
                showAlertMessage('Errore vecchio CMS', 'Tabella vecchio CMS vuota o non presente nel database');
            }
        } catch(Exception $ex) {
            showAlertMessage('Errore vecchio CMS', 'Tabella vecchio CMS vuota o non presente nel database');
        }
    break;

    case("users"):
        executeQuery("TRUNCATE TABLE zfcms_users ");
        
        $result = getRecord("SELECT * FROM utenti");
        if ( is_array($result) ) {
            
            $result = executeQuery("INSERT INTO zfcms_users (image, name, email, username, password, newsletter, area, status, role_id ) 
(SELECT 'noimg.gif', nome, mail, username, password, newsletter, settore, 'active', livello FROM utenti ) ", 'success');
            if ( is_numeric($result) ) {
                
                showAlertMessage('Utenti importati: '.$result, 'Importazione utenti completata con successo', 'success');
                
                // TODO: import FROM permessi_utenti, inserire cognome (ultima parola se ce ne + d una nel nome)
                
            } else {
                
                if (!empty($result)) {
                    $msg .= 'Messaggio generato: '.$result;
                } else {
                    $msg = 'Errore importazione dati dalla tabella utenti (vecchio CMS)';
                }
                
                showAlertMessage('Errore importazione utenti', $msg);
            }
        } else {
            showAlertMessage('Errore query vecchio CMS', 'Tabella vecchio CMS vuota o non presente nel database');
        }
    break;
    /*
    case("modules"):
        
    break;
    */
    case("stato-civile"):

        // Clean old data
        executeQuery("TRUNCATE TABLE zfcms_comuni_stato_civile_articoli ");
        executeQuery("TRUNCATE TABLE zfcms_comuni_stato_civile_sezioni ");
        
        /* Delete attachments (TO DELETE) ... */
        executeQuery("TRUNCATE TABLE zfcms_attachments ");
        executeQuery("TRUNCATE TABLE zfcms_attachments_options ");
        executeQuery("TRUNCATE TABLE zfcms_attachments_relations ");
        
        $resultArticoli = executeQuery("INSERT INTO zfcms_comuni_stato_civile_articoli (id, titolo, progressivo, anno, data, ora, attivo, scadenza, utente_id, sezione_id) (SELECT id, titolo, progressivo, anno, data, ora, attivo, scadenza, id_utente, id_sezione FROM statocivile_articoli) ");
        
        $resultSezioni = executeQuery("INSERT INTO zfcms_comuni_stato_civile_sezioni (nome, attivo, data_inserimento, data_ultimo_aggiornamento) (SELECT nome, attivo, NOW(), NOW() FROM statocivile_sezioni) ");
        
        /* Extract blob files and copy them into the dedicated directory */
        $attachments = getRecord("SELECT sca.id AS id, id_statocivile, nome, id_mime, mimetype, dati, posizione, size FROM statocivile_allegati sca, mimetype m WHERE (sca.id_mime = m.id) ");
        if (is_array($attachments)) {
            $i=0;
            foreach ($attachments as $attachment) {
                
                $insertAttach = executeQuery("INSERT INTO zfcms_attachments (name, size, state, insert_date) (SELECT nome, size, 'active', NOW() FROM statocivile_allegati WHERE id = '".$attachment['id']."' ) ");
                
                $lastID = getRecord("SELECT last_insert_id() AS last_insert_id ");
                
                $insertAttachOption = executeQuery("INSERT INTO zfcms_attachments_options (title, description, attachment_id) VALUES ('".$attachment['nome']."', '', '".$lastID[0]['last_insert_id']."') ");
                
                $insertAttacRelations = executeQuery("INSERT INTO zfcms_attachments_relations (attachment_id, reference_id, module_id) VALUES ('".$lastID[0]['last_insert_id']."', ".$attachment['id'].", '13' ) ");

                $pathInfo = pathinfo($attachment['nome']);
                
                $filename = uniqid().'.'.$pathInfo['extension'];

                $fp = fopen('../public/frontend/media/stato-civile/'.$filename, 'w');
                fwrite($fp, $attachment['dati']);
                fclose($fp);
                $i++;
            }
        }

        showAlertMessage('Stato civile', 'Articoli importati: '.$resultArticoli.'<br>Sezioni: '.$resultSezioni.'<br>Allegati: '.$i, 'success');
        
    break;

    case("albo-pretorio"):
        /* Clean old data */
        executeQuery("TRUNCATE TABLE zfcms_comuni_albo_articoli ");
        executeQuery("TRUNCATE TABLE zfcms_comuni_albo_sezioni ");
        
        /* Delete attachments (TO DELETE) ... */
        executeQuery("TRUNCATE TABLE zfcms_attachments ");
        executeQuery("TRUNCATE TABLE zfcms_attachments_options ");
        executeQuery("TRUNCATE TABLE zfcms_attachments_relations ");
        
        /* Import data */
        $resultArticoli = executeQuery("INSERT INTO zfcms_comuni_albo_articoli ( SELECT * FROM albo_articoli ) ");
        
        /* Correct HTML specialchars */
        $result = getRecord("SELECT * FROM zfcms_comuni_albo_articoli");
        if ( is_array($result) ) {
            foreach($result as $articolo) {
                executeQuery("UPDATE zfcms_comuni_albo_articoli SET titolo='". htmlentities(addslashes($articolo['titolo']))."' WHERE id = '".$articolo['id']."' ");
            }
        }
        
        $resultSezioni = executeQuery("INSERT INTO zfcms_comuni_albo_sezioni ( SELECT * FROM albo_sezioni ) ");
        
        /* Extract files one by one (cannot select all because the blob are too big and it exhausts memory), copy files one by one */
        $attachmentsIds = getRecord("SELECT aa.id AS id FROM albo_allegati aa LIMIT 3");
        if (is_array($attachmentsIds)) {
            foreach($attachmentsIds as $attachmentsId) {
                $attachments = getRecord("SELECT aa.id AS id, id_albo, nome, id_mime, dati, posizione, size FROM albo_allegati aa, mimetype m WHERE (aa.id_mime = m.id) AND aa.id = '".$attachmentsId['id']."' ");
                if (is_array($attachments)) {
                    $moduleId = 3;
                    $i=0;
                    foreach($attachments as $attachment) {

                        $pathInfo = pathinfo($attachment['nome']);
                        $filename = uniqid().'.'.$pathInfo['extension'];

                        $fp = fopen('../public/frontend/media/albo-pretorio/'.$filename, 'w');
                        fwrite($fp, $attachment['dati']);
                        fclose($fp);

                        $insertAttach = executeQuery("INSERT INTO zfcms_attachments (name, size, state, insert_date) (SELECT '".$filename."', size, 'active', NOW() FROM albo_allegati WHERE id = '".$attachment['id']."' ) ");

                        $lastID = getRecord("SELECT last_insert_id() AS last_insert_id ");

                        $insertAttachOption = executeQuery("INSERT INTO zfcms_attachments_options (title, description, attachment_id) VALUES ('".$filename."', '', '".$lastID[0]['last_insert_id']."') ");

                        $insertAttacRelations = executeQuery("INSERT INTO zfcms_attachments_relations (attachment_id, reference_id, module_id) VALUES ('".$lastID[0]['last_insert_id']."', ".$attachment['id'].", '".$moduleId."' ) ");

                        $i++;

                        // echo "Allegati inseriti: ".$insertAttach."<br> Allegati opzioni: ".$insertAttachOption."<br> Allegati relazioni: ".$insertAttacRelations;
                    }
                }
            }
        }
        showAlertMessage('Albo pretorio', 'Articoli importati: '.$resultArticoli.'<br>Sezioni: '.$resultSezioni.'<br> Allegati: '.$i, 'success');
    break;

    case("amministrazione-trasparente"):
        $q = "ammaperta_allegati";
        
        $q = "zfcms_comuni_         ammaperta_articoli ";
        
        $q = " ammaperta_resp_proc ";
        
        $q = "ammaperta_sezioni ";
        
    break;

    case("contratti-pubblici"):
        /* Delete old data */
        executeQuery("TRUNCATE TABLE zfcms_comuni_contratti ");
        executeQuery("TRUNCATE TABLE zfcms_comuni_contratti_partecipanti ");
        executeQuery("TRUNCATE TABLE zfcms_comuni_contratti_part_cig ");
        executeQuery("TRUNCATE TABLE zfcms_comuni_contratti_settori ");
        
        /* TODO: import attachments */
        
        $contrattiPubbliciArticoli = executeQuery("INSERT INTO zfcms_comuni_contratti (SELECT * FROM contpub_data ) ");
        
        $contrattiPubbliciPartecipanti = executeQuery("INSERT INTO zfcms_comuni_contratti_partecipanti ( SELECT * FROM contpub_data ) ");
        
        $contrattiPubbliciPartecCig = executeQuery("INSERT INTO zfcms_comuni_contratti_part_cig ( SELECT * FROM contpub_part_cig ) ");
        
        $contrattiPubbliciSettori = executeQuery("INSERT INTO zfcms_comuni_contratti_settori ( SELECT * FROM contpub_sezioni ) ");

        var_dump($contrattiPubbliciArticoli);
        var_dump($contrattiPubbliciPartecipanti);
        var_dump($contrattiPubbliciPartecCig);
        var_dump($contrattiPubbliciSettori);
    break;

    case("enti-terzi"):
        executeQuery("TRUNCATE TABLE zfcms_comuni_rubrica_enti_terzi ");
        
        $rubrica = executeQuery("INSERT INTO zfcms_comuni_rubrica_enti_terzi ( SELECT *, NOW(), NOW() FROM rubrica_et ) ");
        
        showAlertMessage('Rubrica enti terzi', 'Numero contatti importati: '.$rubrica, 'success');
    break;

    case("contenuti"):
        // contents, not ammaperta records...
    break;

    case("foto"):
        // photo records + categories...
    break;

    case("blogs"):
        // eventi
    break;

    /*
    case("forum"):
        
    break;

    
    case("newsletter"):
        
    break;
    */

    case("delete-old-cms"):
        
        $arrayOldCMSTables = array(
            'albo_allegati','albo_articoli','albo_sezioni',
            'ammaperta_allegati','ammaperta_articoli','ammaperta_resp_proc','ammaperta_sezioni',
            'backup',
            'categorie_link', 'categorie_photo', 'config', 'contatti', 'contatti_dett',
            'contenuti','contenuti_allegati',
            'contpub_allegati','contpub_cf','contpub_data','contpub_partecipanti','contpub_part_cig','contpub_resp_proc','contpub_sc_contr','contpub_sezioni',
            'eventi', 'eventi_allegati', 'forum', 'forum_mex', 'forum_topic',
            'lingue', 'link','log', 'mimetype', 'moduli', 'permessi_utente', 'photogallery',
            'rubrica_et', 'sezioni', 'sottosezioni', 
            'statocivile_allegati', 'statocivile_articoli', 'statocivile_sezioni',
            'temi', 'ticket', 'ticket_allegati', 'ticket_impostazioni', 'ticket_mex', 'ticket_topic', 'utenti'
            );
        
        $q = "";
        foreach($arrayOldCMSTables as $arrayOldCMSTable) {
            $q .= "DROP TABLE IF EXISTS $arrayOldCMSTable; ";
        }
        
        $result = executeQuery($q);
        
        showAlertMessage('Tabelle eliminate', 'Tabelle vecchio CMS eliminate', 'success');
        
    break;
}

executeQuery("SET foreign_key_checks = 1");