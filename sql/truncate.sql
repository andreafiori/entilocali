SET foreign_key_checks = 0;

TRUNCATE TABLE zfcms_attachments;
TRUNCATE TABLE zfcms_attachments_mimetype;
TRUNCATE TABLE zfcms_attachments_options;
TRUNCATE TABLE zfcms_attachments_relations;

TRUNCATE TABLE zfcms_comuni_albo_articoli;
TRUNCATE TABLE zfcms_comuni_albo_sezioni;

TRUNCATE TABLE zfcms_comuni_concessione;
TRUNCATE TABLE zfcms_comuni_concessione_modassegn;

TRUNCATE TABLE zfcms_comuni_contratti;
TRUNCATE TABLE zfcms_comuni_contratti_cf;
TRUNCATE TABLE zfcms_comuni_contratti_partecipanti;
TRUNCATE TABLE zfcms_comuni_contratti_relations;
TRUNCATE TABLE zfcms_comuni_contratti_resp_proc;
TRUNCATE TABLE zfcms_comuni_contratti_sc_contr;
TRUNCATE TABLE zfcms_comuni_contratti_settori;

TRUNCATE TABLE zfcms_comuni_contenuti;
TRUNCATE TABLE zfcms_comuni_sezioni;
TRUNCATE TABLE zfcms_comuni_sottosezioni;

TRUNCATE TABLE zfcms_comuni_stato_civile_articoli;
TRUNCATE TABLE zfcms_comuni_stato_civile_sezioni;

TRUNCATE TABLE zfcms_comuni_rubrica_enti_terzi;

TRUNCATE TABLE zfcms_channels;
TRUNCATE TABLE zfcms_contacts;
TRUNCATE TABLE zfcms_config;

TRUNCATE TABLE zfcms_faq_answers;
TRUNCATE TABLE zfcms_faq_questions;

TRUNCATE TABLE zfcms_geo_comuni;
TRUNCATE TABLE zfcms_geo_comuni_cap;
TRUNCATE TABLE zfcms_geo_comuni_cap_quartieri;
TRUNCATE TABLE zfcms_geo_comuni_quartieri;
TRUNCATE TABLE zfcms_geo_nazioni;
TRUNCATE TABLE zfcms_geo_province;
TRUNCATE TABLE zfcms_geo_regioni;

TRUNCATE TABLE zfcms_homepage;
TRUNCATE TABLE zfcms_homepage_blocks;

TRUNCATE TABLE zfcms_languages;
TRUNCATE TABLE zfcms_languages_labels;

TRUNCATE TABLE zfcms_logs;

TRUNCATE TABLE zfcms_modules;
TRUNCATE TABLE zfcms_modules_options;

TRUNCATE TABLE zfcms_newsletters;
TRUNCATE TABLE zfcms_newsletter_emails;
TRUNCATE TABLE zfcms_newsletter_templates;

TRUNCATE TABLE zfcms_posts;
TRUNCATE TABLE zfcms_posts_categories;
TRUNCATE TABLE zfcms_posts_relations;

/* E-commerce tables
TRUNCATE TABLE zfcms_products;
TRUNCATE TABLE zfcms_products_availability;
TRUNCATE TABLE zfcms_products_brands;
TRUNCATE TABLE zfcms_products_invoices;
TRUNCATE TABLE zfcms_products_offers;
TRUNCATE TABLE zfcms_products_orders;
TRUNCATE TABLE zfcms_products_shipments;
TRUNCATE TABLE zfcms_products_shipments_registry;
TRUNCATE TABLE zfcms_products_shipments_types;
*/

TRUNCATE TABLE zfcms_tickets;
TRUNCATE TABLE zfcms_tickets_messages;

/*
TRUNCATE TABLE zfcms_users;
TRUNCATE TABLE zfcms_users_api_keys;
TRUNCATE TABLE zfcms_users_bookmarks;
TRUNCATE TABLE zfcms_users_settori;
TRUNCATE TABLE zfcms_users_roles;
TRUNCATE TABLE zfcms_users_roles_permissions;
*/
TRUNCATE TABLE zfcms_users_roles_permissions_relations;
TRUNCATE TABLE zfcms_users_resp_proc;
TRUNCATE TABLE zfcms_users_todo;

SET foreign_key_checks = 1;