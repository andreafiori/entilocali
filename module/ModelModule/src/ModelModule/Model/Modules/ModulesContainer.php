<?php

namespace ModelModule\Model\Modules;

/**
 * Stati module IDs
 */
class ModulesContainer
{
    const contenuti_id                      = 2;

    const albo_pretorio_id                  = 3;

    const amministrazione_trasparente_id    = 19;

    const contratti_pubblici_id             = 17;

    const atti_concessione                  = 15;

    const stato_civile_id                   = 13;

    const blogs                             = 10;

    const photo                             = 8;

    const newsletter                        = 6;

    /**
     * Recover module ID from a module code string
     *
     * @param string $moduleCode
     * @return int
     */
    public static function recoverIdFromModuleCode($moduleCode)
    {
        switch($moduleCode) {
            default:
                return self::contenuti_id;
            break;

            case("amministrazione-trasparente"):
                return self::amministrazione_trasparente_id;
            break;

            case("albo-pretorio"):
                return self::albo_pretorio_id;
            break;

            case("atti-concessione"):
                return self::atti_concessione;
            break;

            case("contratti-pubblici"):
                return self::contratti_pubblici_id;
            break;

            case("stato-civile"):
                return self::stato_civile_id;
            break;

            case("blogs"):
                return self::blogs;
            break;

            case("photo"):
                return self::photo;
            break;
        }
    }
}
