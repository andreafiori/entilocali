<?php

namespace Admin\Model\Contenuti;

use Application\Model\QueryBuilderHelperAbstract;

class ContenutiGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("contenuti.id, contenuti.anno, contenuti.numero, 
            contenuti.titolo, contenuti.sommario, contenuti.testo, 
            contenuti.dataInserimento, contenuti.dataScadenza,
            contenuti.attivo, contenuti.home, contenuti.annoammtrasp, contenuti.slug,
            IDENTITY(contenuti.sottosezione) AS sottosezione,
            IDENTITY(contenuti.utente) AS utente,

            sezione.nome AS nomeSezione,

            sottosez.nome AS nomeSottosezione,

            u.name, u.surname,

            languages.id AS languageId, languages.abbreviation1
        ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniContenuti', 'contenuti')
                                ->join('contenuti.sottosezione', 'sottosez')
                                ->join('contenuti.utente', 'u')
                                ->join('sottosez.sezione', 'sezione')
                                ->join('sezione.modulo', 'modulo')
                                ->join('sezione.lingua', 'languages')
                                ->where('( contenuti.sottosezione = sottosez.id
                                        AND contenuti.utente = u.id 
                                        AND sottosez.sezione = sezione.id
                                        AND sezione.modulo = modulo.id
                                        AND sezione.lingua = languages.id
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
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setExcludeSezioneId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezione.id != :excludeSottoSezioneId ');
            $this->getQueryBuilder()->setParameter('excludeSottoSezioneId', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('sezione.id NOT IN ( :excludeSottoSezioneId ) ');
            $this->getQueryBuilder()->setParameter('excludeSottoSezioneId', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSezioneId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezione.id = :sezioneId ');
            $this->getQueryBuilder()->setParameter('sezioneId', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setExcludeSottoSezioneId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sottosez.id != :excludeSottoSezioneId ');
            $this->getQueryBuilder()->setParameter('excludeSottoSezioneId', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('sottosez.id NOT IN ( :excludeSottoSezioneId ) ');
            $this->getQueryBuilder()->setParameter('excludeSottoSezioneId', $id);
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
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setNumero($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('contenuti.numero = :numero ');
            $this->getQueryBuilder()->setParameter('numero', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $anno
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAnno($anno)
    {
        if ( is_numeric($anno) ) {
            $this->getQueryBuilder()->andWhere('contenuti.anno = :anno ');
            $this->getQueryBuilder()->setParameter('anno', $anno);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $dataScadenza
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setDataScadenza($dataScadenza)
    {
        if ( isset($dataScadenza) ) {
            $this->getQueryBuilder()->andWhere('contenuti.dataScadenza = :scadenza ');
            $this->getQueryBuilder()->setParameter('scadenza', $dataScadenza);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $noScaduti
     */
    public function setNoScaduti($noScaduti)
    {
        if ($noScaduti === 1) {
            $this->getQueryBuilder()->andWhere("( contenuti.dataScadenza > '".date("Y-m-d H:i:s")."' OR contenuti.dataScadenza = '0000-00-00 00:00:00') ");
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModulo($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezione.modulo = :moduloId ');
            $this->getQueryBuilder()->setParameter('moduloId', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAttivo($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('contenuti.attivo = :attivo ');
            $this->getQueryBuilder()->setParameter('attivo', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setUtente($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('contenuti.utente = :utenteId ');
            $this->getQueryBuilder()->setParameter('utenteId', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setIsAmmTrasparente($bool)
    {
        if ( is_numeric($bool) ) {
            $this->getQueryBuilder()->andWhere('contenuti.isAmmTrasparente = :isammtrasp ');
            $this->getQueryBuilder()->setParameter('isammtrasp', $bool);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setShowToAll($showToAll)
    {
        if ( is_numeric($showToAll) ) {
            $this->getQueryBuilder()->andWhere('sezione.showToAll = :showToAll ');
            $this->getQueryBuilder()->setParameter('showToAll', $showToAll);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param $lingua
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLingua($lingua)
    {
        if ( !empty($lingua) ) {
            $this->getQueryBuilder()->andWhere('sezione.lingua = :lingua ');
            $this->getQueryBuilder()->setParameter('lingua', $lingua);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param $abbreviation
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguageAbbreviation($abbreviation)
    {
        if ( !empty($abbreviation) ) {
            $this->getQueryBuilder()->andWhere('languages.abbreviation1 = :languageAbbreviation ');
            $this->getQueryBuilder()->setParameter('languageAbbreviation', $abbreviation);
        }

        return $this->getQueryBuilder();
    }
}
