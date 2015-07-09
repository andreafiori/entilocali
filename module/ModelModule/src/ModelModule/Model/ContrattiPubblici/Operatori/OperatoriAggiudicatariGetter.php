<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use ModelModule\Model\QueryBuilderHelperAbstract;

class OperatoriAggiudicatariGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('contratto.id, contratto.titolo, partecipante.id AS idPartecipante,
                                     partecipante.cf, partecipante.nome, partecipante.ragioneSociale,

                                     ccr.id AS idRelation, ccr.aggiudicatario, ccr.membro, ccr.stato, ccr.gruppo
                                    ');

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
             ->from('Application\Entity\ZfcmsComuniContrattiRelations', 'ccr')
             ->join('ccr.partecipante', 'partecipante')
             ->join('ccr.contratto', 'contratto')
             ->where(' (ccr.partecipante = partecipante.id AND ccr.contratto = contratto.id) ');

        return $this->getQueryBuilder();
    }

    /**
     * Set contratto ID
     *
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setContrattoId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('ccr.contratto = :contrattoId ');
            $this->getQueryBuilder()->setParameter('contrattoId', $id);
        }

        return $this->getQueryBuilder();
    }
}