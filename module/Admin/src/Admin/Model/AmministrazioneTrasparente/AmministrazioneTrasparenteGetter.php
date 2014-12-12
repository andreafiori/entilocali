<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class AmministrazioneTrasparenteGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        // SELECT id, beneficiario, titolo, importo, ufficioresponsabile, modassegn, 
        //  
        // data, progressivo, anno, utenti.settore, scadenza, ammaperta_resp_proc.nome_resp 
        // 
        // ammaperta_sezioni.nome, ammaperta_sezioni.responsabile,
        // 
        // FROM ammaperta_articoli, ammaperta_sezioni, ammaperta_resp_proc, utenti
        // 
        //   WHERE ((ammaperta_articoli.id_sezione = ammaperta_sezioni.id 
        //   AND ammaperta_resp_proc.id = ammaperta_articoli.id_resp_proc) 
        //   AND (utenti.id = ammaperta_articoli.id_utente)) 
        //   AND (scadenza >= '".date('Y-m-d-')."' OR scadenza = '0000-00-00') 
        //   AND ammaperta_articoli.attivo = '1'
        
        $this->setSelectQueryFields('ret.id, ret.nome, ret.email ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsComuniAmmapertaArticoli aa')
                                ->join('aa.utente', 'u')
                                ->join('aa.respProc', 'rp')
                                ->where(' (aa.utente = u.id) AND (aa.resp_proc = rp.id) ')
                                ->andWhere("AND (aa.scadenza >= '".date('Y-m-d-')."' OR aa.scadenza = '0000-00-00') ")
                                ->andWhere("AND as.attivo = '1' ");
        
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
