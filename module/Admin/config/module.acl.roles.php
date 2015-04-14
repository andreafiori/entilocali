<?php
return array(
    /* Enti terzi */
    'admin/enti-terzi-summary' => array(
        'resources' => array( 'enti_terzi_add', 'enti_terzi_update' )
    ),
    'admin/enti-terzi-form' => array(
        'resources' => array( 'enti_terzi_add', 'enti_terzi_update'  )
    ),
    /* Albo pretorio */
    'admin/albo-pretorio-summary' => array(
        'resources' => array( 'albo_pretorio_add', 'albo_pretorio_update')
    ),
    'admin/albo-pretorio-form' => array(
        'resources' => array( 'albo_pretorio_add', 'albo_pretorio_update')
    ),
    /* Posizioni Sezioni contenuti e amministrazione trasparente */
    'admin/posizioni-sezioni' => array(
        'resources' => array( 'contenuti_sezioni_update' )
    ),
    'admin/posizioni-sezioni-update' => array(
        'resources' => array( 'contenuti_sezioni_update' )
    ),

    /* Responsabili procedimento */
    'admin/users-resp-proc-management' => array(
        'resources' => array( 'contenuti_sezioni_update' )
    ),
    /* Users roles */
    'users-roles-permissions' => array(
        'resources' => array( 'users_roles_add', 'users_roles_update' )
    ),

    /* Datatables summary */
    'datatables' => array(
        'contenuti' => array(
            'resources' => array(
                'contenuti_add', 'contenuti_viewall', 'contenuti_update'
            )
        ),
        'sezioni-contenuti' => array(
            'resources' => array(
                'contenuti_sezioni_add', 'contenuti_sezioni_update',
            )
        ),
        'sottosezioni-contenuti' => array(
            'resources' => array(
                'contenuti_sottosezioni_add', 'contenuti_sottosezioni_update',
            )
        ),
        'albo-pretorio' => array(
            'resources' => array(
                'albo_pretorio_add', 'albo_pretorio_update'
            )
        ),
        'albo-pretorio-sezioni' => array(
            'resources' => array(
                'albo_pretorio_sezioni_add', 'albo_pretorio_sezioni_update'
            )
        ),
        /*
        'atti-ufficiali' => array(
            'resources' => array(
                'atti_ufficiali_add', 'atti_ufficiali_update'
            )
        ),
        */
        'enti-terzi' => array(
            'resources' => array(
                'enti-terzi_add', 'enti-terzi_update'
            )
        ),
        'stato-civile' => array(
            'resources' => array(
                'stato_civile_add', 'stato_civile_update'
            )
        ),
        'stato-civile-sezioni' => array(
            'resources' => array(
                'stato_civile_sezioni_add', 'stato_civile_sezioni_update'
            )
        ),
        'atti-concessione' => array(
            'resources' => array(
                'atti_concessione_add', 'atti_concessione_update'
            )
        ),
        'atti-concessione-mod-assign' => array(
            'resources' => array(
                'atti_concessione_mod-assign_add', 'atti_concessione_update'
            )
        ),
        'contratti-pubblici' => array(
            'resources' => array(
                'contratti_pubblici_add', 'contratti_pubblici_update'
            )
        ),
        'contratti-pubblici-scelta-contraente' => array(
            'resources' => array(
                'contratti_pubblici_scelta_contraente_add', 'contratti_pubblici_scelta_contraente_update'
            )
        ),
        'users' => array(
            'resources' => array(
                'users_add', 'users_update'
            )
        ),
        'users-roles' => array(
            'resources' => array(
                'users_roles_add', 'users_roles_update'
            )
        ),
        'users-settori' => array(
            'resources' => array(
                'users_settori_add', 'users_settori_update'
            )
        ),
    ),
);
