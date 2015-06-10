<?php

namespace ModelModule\Model\ContrattiPubblici;

use ModelModule\Model\QueryBuilderHelperAbstract;

class ContrattiPubbliciGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(cc.id) AS id, cc.beneficiario, cc.titolo,
                cc.dataDetermina, cc.numeroDetermina,
                cc.importoAggiudicazione, cc.importoLiquidato, cc.dataInizioLavori, cc.dataFineLavori,
                cc.progressivo, cc.anno, cc.dataInserimento, cc.oraInserimento, cc.attivo, cc.scadenza, cc.cig,
                cc.numeroOfferte, IDENTITY(cc.respProc) AS respProcId, IDENTITY(cc.settore) AS settoreId,
                IDENTITY(cc.scContr) AS sceltaContraenteId, IDENTITY(cc.utente) AS contrattiUtenteId,

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
                                ->join('cc.settore', 'settore')
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
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setUtente($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('cc.utente = :utente ');
            $this->getQueryBuilder()->setParameter('utente', $id);
        }
        
        return $this->getQueryBuilder();
    }
}
