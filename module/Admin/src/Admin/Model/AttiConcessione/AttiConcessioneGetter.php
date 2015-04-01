<?php

namespace Admin\Model\AttiConcessione;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class AttiConcessioneGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields("atti.id, atti.beneficiario, atti.titolo, atti.importo,
                atti.ufficioresponsabile, atti.data AS dataInserimento, atti.ora, atti.progressivo,
                atti.anno, atti.scadenza, atti.attivo,
                IDENTITY(atti.settore) AS ufficioResponsabile, IDENTITY(atti.respProc) AS respProc,

                u.id, u.name, u.surname,

                modAssegnazione.id, modAssegnazione.nome AS nomemodAssegnazione,
                
                asettori.nome AS nomeSezione,

                IDENTITY( respProcedimento.user ) AS idResponsabileProc,
                respProcedimentoUser.name AS nomeResponsabileProc,
                respProcedimentoUser.surname AS cognomeResponsabileProc
        ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniConcessione', 'atti')
                                ->join('atti.modAssegnazione', 'modAssegnazione')
                                ->join('atti.utente', 'u')
                                ->join('atti.settore', 'asettori')
                                ->join('atti.respProc', 'respProcedimento')
                                ->join('respProcedimento.user', 'respProcedimentoUser')
                                ->where("(
                                        atti.utente = u.id
                                        AND (atti.scadenza >= '".date('Y-m-d')."' OR atti.scadenza = '0000-00-00')
                                        AND atti.settore = asettori.id
                                        AND atti.respProc = respProcedimento.id
                                        AND respProcedimento.user = respProcedimentoUser.id
                                        )");
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('atti.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('atti.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
}
