<?php

namespace ModelModule\Model\AttiConcessione;

use ModelModule\Model\QueryBuilderHelperAbstract;

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
                IDENTITY(atti.modAssegnazione) AS modAssegnazione,

                u.id AS userId, u.name, u.surname,

                modAssegn.id AS modAssegnId, modAssegn.nome AS nomemodAssegnazione,
                
                asettori.nome AS nomeSezione,

                IDENTITY( respProcedimento.user ) AS respProId,
                respProcedimentoUser.name AS nomeResponsabileProc,
                respProcedimentoUser.surname AS cognomeResponsabileProc
        ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniConcessione', 'atti')
                                ->join('atti.modAssegnazione', 'modAssegn')
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
        
        if ( is_array($id) ) {
            $this->getQueryBuilder()->andWhere('atti.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param $attivo
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAttivo($attivo)
    {
        if ( is_numeric($attivo) ) {
            $this->getQueryBuilder()->andWhere('atti.attivo = :attivo ');
            $this->getQueryBuilder()->setParameter('attivo', $attivo);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param $anno
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAnno($anno)
    {
        if ( is_numeric($anno) ) {
            $this->getQueryBuilder()->andWhere('atti.anno = :anno ');
            $this->getQueryBuilder()->setParameter('anno', $anno);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $search
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setBeneficiarioSearch($search)
    {
        if (!empty($search)) {
            $this->getQueryBuilder()->andWhere(' ( atti.beneficiario LIKE :beneficiarioSearch ) ');
            $this->getQueryBuilder()->setParameter('beneficiarioSearch', $search);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $importo
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setImporto($importo)
    {
        if (!empty($importo)) {
            $this->getQueryBuilder()->andWhere(' ( atti.importo = :importo ) ');
            $this->getQueryBuilder()->setParameter('importo', $importo);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $progressivo
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setProgressivo($progressivo)
    {
        if ( is_numeric($progressivo) ) {
            $this->getQueryBuilder()->andWhere(' ( atti.progressivo = :progressivo ) ');
            $this->getQueryBuilder()->setParameter('progressivo', $progressivo);
        }

        return $this->getQueryBuilder();
    }

    /**
     * Set free search
     *
     * @param string $search
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setFreeSearch($search)
    {
        if (!empty($search)) {
            $search = strtolower($search);

            $this->getQueryBuilder()->andWhere(' ( LOWER(atti.beneficiario) LIKE :freeSearch OR LOWER(atti.titolo) LIKE :freeSearch ) ');
            $this->getQueryBuilder()->setParameter('freeSearch', "%$search%");
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $settoreId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSettoreId($settoreId)
    {
        if ( !empty($settoreId) ) {
            $this->getQueryBuilder()->andWhere('atti.settore = :settoreId ');
            $this->getQueryBuilder()->setParameter('settoreId', $settoreId);
        }

        return $this->getQueryBuilder();
    }
}
