<?php

namespace Admin\Model\AttiConcessione;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class AttiConcessioneGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("aa.id, aa.beneficiario, aa.titolo, aa.importo, 
                aa.ufficioresponsabile, aa.modassegn, aa.data, aa.ora, aa.progressivo, aa.anno, 
                aa.scadenza, aa.attivo,
                
                u.id, u.name, u.surname, u.settore,
                
                rp.nomeResp,
                
                asettori.nome AS nomeSezione, asettori.responsabile
        ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniConcessione', 'aa')
                                ->join('aa.utente', 'u')
                                ->join('aa.settore', 'asettori')
                                ->join('aa.respProc', 'rp')
                                ->where(' (aa.utente = u.id) AND (aa.respProc = rp.id) ')
                                ->andWhere(" (aa.scadenza >= '".date('Y-m-d-')."' OR aa.scadenza = '0000-00-00') AND (aa.utente = u.id) ");
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('ret.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('ret.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
}
