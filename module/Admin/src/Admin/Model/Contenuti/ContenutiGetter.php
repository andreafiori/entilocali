<?php

namespace Admin\Model\Contenuti;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  11 January 2015
 */
class ContenutiGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("contenuti.id, contenuti.anno, contenuti.numero, 
            contenuti.titolo, contenuti.sommario, contenuti.testo, 
            contenuti.dataInserimento, contenuti.dataScadenza,
            contenuti.attivo, contenuti.home, contenuti.annoammtrasp,
            IDENTITY(contenuti.sottosezione) AS sottosezione,

            sezione.nome AS nomeSezione,

            sottosez.nome AS nomeSottosezione,

            u.name, u.surname
        ");

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsComuniContenuti', 'contenuti')
                                ->join('contenuti.sottosezione', 'sottosez')
                                ->join('contenuti.utente', 'u')
                                ->join('sottosez.sezione', 'sezione')
                                ->join('sezione.modulo', 'modulo')
                                ->where('( contenuti.sottosezione = sottosez.id
                                        AND contenuti.utente = u.id 
                                        AND sottosez.sezione = sezione.id
                                        AND sezione.modulo = modulo.id
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
            $this->getQueryBuilder()->andWhere('contenuti.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('contenuti.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSottosezione($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('contenuti.sottosezione = :sottosezione ');
            $this->getQueryBuilder()->setParameter('sottosezione', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('contenuti.sottosezione IN ( :sottosezione ) ');
            $this->getQueryBuilder()->setParameter('sottosezione', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $id
     */
    public function setNumero($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('contenuti.numero = :numero ');
            $this->getQueryBuilder()->setParameter('numero', $id);
        }
    }
    
    /**
     * @param int $anno
     */
    public function setAnno($anno)
    {
        if ( is_numeric($anno) ) {
            $this->getQueryBuilder()->andWhere('contenuti.anno = :anno ');
            $this->getQueryBuilder()->setParameter('anno', $anno);
        }
    }
    
    /**
     * @param \Datetime $dataScadenza
     */
    public function setDataScadenza($dataScadenza)
    {
        if ( isset($dataScadenza) ) {
            $this->getQueryBuilder()->andWhere('contenuti.dataScadenza = :scadenza ');
            $this->getQueryBuilder()->setParameter('scadenza', $dataScadenza);
        }
    }
    
    /**
     * @param int $noScaduti
     */
    public function setNoScaduti($noScaduti)
    {
        if ($noScaduti === 1) {
            $this->getQueryBuilder()->andWhere("( contenuti.dataScadenza > '".date("Y-m-d H:i:s")."' OR contenuti.dataScadenza = '0000-00-00 00:00:00') ");
        }
    }
    
    /**
     * @param int $id
     */
    public function setUserId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('contenuti.utente = :userid ');
            $this->getQueryBuilder()->setParameter('userid', $id);
        }
    }
    
    /**
     * @param int $id
     */
    public function setModulo($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezione.modulo = :moduloId ');
            $this->getQueryBuilder()->setParameter('moduloId', $id);
        }
    }
    
    /**
     * @param int $id
     */
    public function setAttivo($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('contenuti.attivo = :attivo ');
            $this->getQueryBuilder()->setParameter('attivo', $id);
        }
    }
}
