-- Disable foreign checks
SET foreign_key_checks = 0;


-- Sezioni
TRUNCATE table zfcms_comuni_sezioni;
INSERT INTO zfcms_comuni_sezioni (id, nome, colonna, posizione, link_macro, lingua, blocco, modulo_id
, attivo, url, css_id
-- , image, slug, title, utente_id, seo_title, seo_description, seo_keywords
)
  (SELECT * FROM sezioni);
/*
UPDATE zfcms_comuni_sezioni SET nome = REPLACE(nome, 'à', '&agrave;') WHERE nome LIKE '%à%';
UPDATE zfcms_comuni_sezioni SET nome = REPLACE(nome, 'ò', '&ograve;') WHERE nome LIKE '%ò%';
UPDATE zfcms_comuni_sezioni SET nome = REPLACE(nome, 'ì', '&igrave;') WHERE nome LIKE '%ì%';
*/


-- Sottosezioni
TRUNCATE table zfcms_comuni_sottosezioni;
INSERT INTO zfcms_comuni_sottosezioni 
(id, sezione_id, nome, immagine, url, posizione, attivo, profondita_a, profondita_da, is_ss)
(SELECT * FROM sottosezioni);



-- Contenuti
TRUNCATE table zfcms_comuni_contenuti;
INSERT INTO zfcms_comuni_contenuti 
(id, sottosezione_id, anno, numero, titolo, sommario, testo, 
data_inserimento, data_scadenza, data_invio_regione, attivo, home, evidenza, utente_id, 
rss, pub_albo_comune, data_rettifica, path, tabella, check_atti, annoammtrasp) 
(SELECT * FROM contenuti);
-- UPDATE zfcms_comuni_contenuti SET testo = REPLACE(testo, '<p> </p>', '<br>') WHERE testo LIKE '%<p> </p>%';
-- UPDATE zfcms_comuni_contenuti SET sommario = REPLACE(sommario, '<p> </p>', '<br>') WHERE sommario LIKE '%<p> </p>%';


-- Utenti
TRUNCATE table zfcms_users;
INSERT INTO zfcms_users (id, name, email, username, password, settore, livello)
(SELECT id, nome, mail, username, password, settore, role_id FROM utenti);

-- Albo pretorio

	
	-- Albo pretorio Articoli
	TRUNCATE table zfcms_comuni_albo_articoli;
	INSERT INTO zfcms_comuni_albo_articoli (id, utente_id, sezione_id, numero_progressivo, numero_atto, anno, data_attivazione, ora_attivazione, data_pubblicare, ora_pubblicare, scadenza, data_scadenza, titolo, attivo, pubblicare, annullato, rettifica_id, data_invio_regione, anno_atto, home, ente_terzo, fonte_url, note, data_rettifica, check_rettifica)
	 (SELECT * FROM albo_articoli);

	-- Albo pretorio Sezioni
	TRUNCATE table zfcms_comuni_albo_sezioni;
	INSERT INTO zfcms_comuni_albo_sezioni (SELECT * FROM albo_sezioni);


-- Migrazione contratti pubblici
	-- Contratti
	TRUNCATE table zfcms_comuni_contratti;
	INSERT INTO zfcms_comuni_contratti (id, beneficiario, titolo, importo_aggiudicazione, importo_liquidato, operatori, numero_offerte, modassegn, data_inizio_lavori, data_fine_lavori, progressivo, anno, data, ora, attivo, scadenza, utente_id, settore_id, resp_proc_id, sc_contr_id, cig) (SELECT * FROM contpub_data)

	-- Partecipanti
	TRUNCATE table zfcms_comuni_contratti_partecipanti;
	INSERT INTO zfcms_comuni_contratti_partecipanti (SELECT * FROM contpub_partecipanti)
	
	-- Relazioni \ CIG
	TRUNCATE table zfcms_comuni_contratti_relations;
	INSERT INTO zfcms_comuni_contratti_relations 
	(SELECT * FROM contpub_part_cig)
	
	-- Responsabili procedura
	TRUNCATE table zfcms_comuni_contratti_resp_proc;
	INSERT INTO zfcms_comuni_contratti_resp_proc (SELECT * FROM contpub_resp_proc)
	
	-- Scelta contraente
	TRUNCATE table zfcms_comuni_contratti_sc_contr;
	INSERT INTO zfcms_comuni_contratti_sc_contr (SELECT * FROM contpub_sc_contr)
	
	-- Settori
	TRUNCATE table zfcms_comuni_contratti_settori;
	INSERT INTO zfcms_comuni_contratti_settori 
	(SELECT * FROM contpub_sezioni)

	
	

-- Migrazione atti di concessione
	-- Articoli
	TRUNCATE table zfcms_comuni_concessione;
	INSERT INTO zfcms_comuni_concessione (id, key_imp, beneficiario, titolo, importo, ufficioresponsabile, modassegn, progressivo, anno, data, ora, attivo, scadenza, flag_allegati, utente_id, settore_id, resp_proc_id)
	(SELECT id, key_imp, beneficiario, titolo, importo, ufficioresponsabile, modassegn, progressivo, anno, data, ora, attivo, scadenza, '0', utente_id, settore_id, resp_proc_id FROM  ammaperta_articoli);
	
	-- TRUNCATE table zfcms_comuni_concessione;
	-- INSERT INTO zfcms_comuni_concessione (id, beneficiario, titolo, importo, ufficioresponsabile, modassegn, progressivo, anno, data, ora, attivo, scadenza, flag_allegati, utente_id, settore_id) (SELECT id, beneficiario, titolo, importo, ufficioresponsabile, modassegn, progressivo, anno, data, ora, attivo, scadenza, '0', id_utente, id_sezione FROM  ammaperta_articoli);
	-- UPDATE zfcms_comuni_concessione SET resp_proc_id = 1;
	-- TODO: remove euro and euro symbols from importo!
	
	-- Sezioni
	TRUNCATE table zfcms_comuni_concessione_settori;
	INSERT INTO zfcms_comuni_concessione_settori (SELECT * FROM  ammaperta_sezioni);
	
	-- Responsabili procedura
	
	-- TODO: allegati, contratti codice fiscale (CF)
	


-- Migrazione Rubrica enti terzi


-- Migrazione Stato Civile
	-- Articoli

	


-- Migrazione eventi
	

-- Migrazione galleria fotografica


-- Migrazione link esterni ?!
	

-- Delete OLD tables
-- DROP TABLE IF EXISTS `albo_allegati`, `albo_articoli`, `albo_sezioni`, `ammaperta_allegati`, `ammaperta_articoli`, `ammaperta_resp_proc`, `ammaperta_sezioni`, `backup`, `categorie_link`, `categorie_photo`, `config`, `contatti`, `contatti_dett`, `contenuti`, `contenuti_allegati`, `contpub_allegati`, `contpub_cf`, `contpub_data`, `contpub_partecipanti`, `contpub_part_cig`, `contpub_resp_proc`, `contpub_sc_contr`, `contpub_sezioni`, `eventi`, `eventi_allegati`, `forum`, `forum_mex`, `forum_topic`, `lingue`, `link`, `log`, `mimetype`, `moduli`, `permessi_utente`, `photogallery`, `rubrica_et`, `sezioni`, `sottosezioni`, `statocivile_allegati`, `statocivile_articoli`, `statocivile_sezioni`, `temi`, `ticket`, `ticket_allegati`, `ticket_impostazioni`, `ticket_mex`, `ticket_topic`, `utenti`;

-- Enable foreign checks
SET foreign_key_checks = 1;
