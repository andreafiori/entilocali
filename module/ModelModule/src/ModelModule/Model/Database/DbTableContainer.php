<?php

namespace ModelModule\Model\Database;

/**
 * @author Andrea Fiori
 * @since  19 March 2015
 */
class DbTableContainer
{
    const attachments                       = 'zfcms_attachments';
    const attachmentsMimeType               = 'zfcms_attachments_mimetype';
    const attachmentsOption                 = 'zfcms_attachments_options';
    const attachmentsRelations              = 'zfcms_attachments_relations';

    const alboArticoli                      = 'zfcms_comuni_albo_articoli';
    const alboSezioni                       = 'zfcms_comuni_albo_sezioni';

    const attiConcessione                   = 'zfcms_comuni_concessione';
    const attiConcessioneModAssegn          = 'zfcms_comuni_concessione_modassegn';

    const contenuti                         = 'zfcms_comuni_contenuti';
    const contratti                         = 'zfcms_comuni_contratti';
    const contrattiCf                       = 'zfcms_comuni_contratti_cf';
    const contrattiPartecipanti             = 'zfcms_comuni_contratti_partecipanti';
    const contrattiRelations                = 'zfcms_comuni_contratti_relations';
    const contrattiRespProc                 = 'zfcms_comuni_contratti_resp_proc';
    const contrattiSceltaContraente         = 'zfcms_comuni_contratti_sc_contr';
    const contrattiSettori                  = 'zfcms_comuni_contratti_settori';

    const sezioni                           = 'zfcms_comuni_sezioni';
    const sottosezioni                      = 'zfcms_comuni_sottosezioni';

    const statoCivileArticoli               = 'zfcms_comuni_stato_civile_articoli';
    const statoCivileSezioni                = 'zfcms_comuni_stato_civile_sezioni';

    const entiTerzi                         = 'zfcms_comuni_rubrica_enti_terzi';

    const channels                          = 'zfcms_channels';
    const contacts                          = 'zfcms_contacts';
    const config                            = 'zfcms_config';

    const faqAnswers                        = 'zfcms_faq_answers';
    const faqQuestions                      = 'zfcms_faq_questions';

    const geoComuni                         = 'zfcms_geo_comuni';
    const geoComuniCap                      = 'zfcms_geo_comuni_cap';
    const geoComuniCapQuartieri             = 'zfcms_geo_comuni_cap_quartieri';
    const geoComuniQuartieri                = 'zfcms_geo_comuni_quartieri';
    const geoNazioni                        = 'zfcms_geo_nazioni';
    const geoProvince                       = 'zfcms_geo_province';
    const geoRegioni                        = 'zfcms_geo_regioni';

    const homepage                          = 'zfcms_homepage';
    const homepageBlocks                    = 'zfcms_homepage_blocks';

    const languages                         = 'zfcms_languages';
    const languagesLabels                   = 'zfcms_languages_labels';

    const logs                              = 'zfcms_logs';

    const modules                           = 'zfcms_modules';
    const modulesOptions                    = 'zfcms_modules_options';

    const newsletter                        = 'zfcms_newsletters';
    const newsletterEmails                  = 'zfcms_newsletter_emails';
    const newsletterTemplates               = 'zfcms_newsletter_templates';
    // zfcms_newsletter_mailings ??

    const posts                             = 'zfcms_posts';
    const postsOptions                      = 'zfcms_posts_options';
    const postsRelations                    = 'zfcms_posts_relations';

    const categories                        = 'zfcms_posts_categories';
    const categoriesOptions                 = 'zfcms_posts_categories_options';

    const products                          = 'zfcms_products';
    const productsAvailability              = 'zfcms_products_availability';
    const productsBrands                    = 'zfcms_products_brands';
    const productsInvoices                  = 'zfcms_products_invoices';
    const productsOffers                    = 'zfcms_products_offers';
    const productsOrders                    = 'zfcms_products_orders';
    const productsShipments                 = 'zfcms_products_shipments';
    const productsShipmentsRegistry         = 'zfcms_products_shipments_registry';
    const productsShipmentsTypes            = 'zfcms_products_shipments_types';

    const tickets                           = 'zfcms_tickets';
    const ticketsMessages                   = 'zfcms_tickets_messages';

    const users                             = 'zfcms_users';
    const usersApiKeys                      = 'zfcms_users_api_keys';
    const usersApiBookmarks                 = 'zfcms_users_bookmarks';

    const usersRoles                        = 'zfcms_users_roles';
    const usersRolesPermissions             = 'zfcms_users_roles_permissions';
    const usersRolesPermissionsRelations    = 'zfcms_users_roles_permissions_relations';

    const usersSettori                      = 'zfcms_users_settori';
    const usersRespProc                     = 'zfcms_users_resp_proc';

    const usersTodo                         = 'zfcms_users_todo';
}