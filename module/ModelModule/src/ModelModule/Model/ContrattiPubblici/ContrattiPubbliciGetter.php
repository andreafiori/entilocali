<?php

namespace ModelModule\Model\ContrattiPubblici;

use ModelModule\Model\QueryBuilderHelperAbstract;

class ContrattiPubbliciGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(cc.id) AS id, cc.beneficiario, cc.titolo,
                cc.dataDetermina, cc.numeroDetermina,
                cc.importoAggiudicazione, cc.importoLiquidato, cc.dataInizioLavori, cc.dataFineLavori,
                cc.progressivo, cc.anno, cc.dataInserimento, cc.oraInserimento, cc.attivo, cc.scadenza, cc.cig,
                cc.numeroOfferte, IDENTITY(cc.respProc) AS respProcId, IDENTITY(cc.settore) AS settoreId,
                IDENTITY(cc.scContr) AS sceltaContraenteId, IDENTITY(cc.utente) AS contrattiUtenteId,
                cc.homepage,

                csc.nomeScelta,

                settore.nome AS nomeUtenteSettore, settore.nome AS nomeSettore,
                
                users.name, users.surname,

                responsabileUsers.name AS responsabileUsersName,
                responsabileUsers.surname AS responsabileUsersSurname
                ');

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsComuniContratti', 'cc')
                                ->join('cc.scContr', 'csc')
                                ->join('cc.utente', 'users')
                                ->leftJoin('cc.settore', 'settore')
                                ->join('cc.respProc', 'responsabile')
                                ->join('responsabile.user', 'responsabileUsers')
                                ->where('
                                        (
                                        cc.scContr = csc.id AND cc.utente = users.id
                                        AND cc.settore = settore.id
                                        AND responsabile.user = responsabileUsers.id
                                        AND cc.respProc = responsabile.id
                                        )
                                        ');
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('cc.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('cc.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $cig
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setCig($cig)
    {
        if ( !empty($cig) ) {
            $this->getQueryBuilder()->andWhere('cc.cig = :cig ');
            $this->getQueryBuilder()->setParameter('cig', $cig);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $anno
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAnno($anno)
    {
        if ( is_numeric($anno) and $anno!=0 ) {
            $this->getQueryBuilder()->andWhere('cc.anno = :anno ');
            $this->getQueryBuilder()->setParameter('anno', $anno);
        }

        return $this->getQueryBuilder();
    }

    /**
     * Set importi condition. TODO: set an interval value using BETWEEN
     *
     * @param number|array $anno
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setImporto($importo)
    {
        if ( !empty($importo) ) {
            $this->getQueryBuilder()->andWhere(' (cc.importoAggiudicazione = :importo OR cc.importoLiquidato = :importo) ');
            $this->getQueryBuilder()->setParameter('importo', $importo);
        }

        return $this->getQueryBuilder();
    }

    /**
     * Set User ID
     *
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setUserId($userId)
    {
        if ( is_numeric($userId) ) {
            $this->getQueryBuilder()->andWhere('cc.utente = :userId ');
            $this->getQueryBuilder()->setParameter('userId', $userId);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * Set Settore ID
     *
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSettoreId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('cc.settore = :settoreId ');
            $this->getQueryBuilder()->setParameter('settoreId', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * Set Not expired
     *
     * @param int $noScaduti
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setNoScaduti($noScaduti)
    {
        if ($noScaduti == 1) {
            $this->getQueryBuilder()->andWhere("( cc.scadenza > '".date("Y-m-d H:i:s")."'
            OR cc.scadenza = '0000-00-00 00:00:00') ");
        }

        return $this->getQueryBuilder();
    }

    /**
     * Only expired
     *
     * @param int $siScaduti
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setScaduti($siScaduti)
    {
        if ($siScaduti == 1) {
            $this->getQueryBuilder()->andWhere("( cc.scadenza < '".date("Y-m-d H:i:s")."'
            OR cc.scadenza != '0000-00-00 00:00:00') ");
        }

        return $this->getQueryBuilder();
    }

    /**
     * Set free text for research
     *
     * @param string $search
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setFreeSearch($search)
    {
        if (!empty($search)) {
            $this->getQueryBuilder()->andWhere(' ( cc.titolo LIKE :freeSearch ) ');
            $this->getQueryBuilder()->setParameter('freeSearch', $search);
        }

        return $this->getQueryBuilder();
    }
}
