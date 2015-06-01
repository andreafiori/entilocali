<?php

namespace ModelModule\Model\Sezioni;

use ModelModule\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SezioniGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields("sezioni.id, sezioni.nome, sezioni.colonna, IDENTITY(sezioni.lingua) AS lingua,
                                    sezioni.url, IDENTITY(sezioni.modulo) AS moduloId, sezioni.attivo,
                                     sezioni.colonna, sezioni.title, sezioni.image, sezioni.blocco,

                                     modulo.code AS moduleCode,

                                     languages.abbreviation1 AS abbr
                                    ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniSezioni', 'sezioni')
                                ->join('sezioni.modulo', 'modulo')
                                ->join('sezioni.lingua', 'languages')
                                ->where("sezioni.id != '' ");

        return $this->getQueryBuilder();
    }

    /**
     * @param int|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezioni.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if ( is_array($id) ) {
            $this->getQueryBuilder()->andWhere('sezioni.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setExcludeId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezioni.id != :excludeId ');
            $this->getQueryBuilder()->setParameter('excludeId', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('sezioni.id NOT IN ( :excludeId ) ');
            $this->getQueryBuilder()->setParameter('excludeId', $id);
        }

        return $this->getQueryBuilder();
    }
    
    /**
     * @param string $colonna
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setColonna($colonna)
    {
        if ( isset($colonna) ) {
            $this->getQueryBuilder()->andWhere('sezioni.colonna = :colonna ');
            $this->getQueryBuilder()->setParameter('colonna', $colonna);
        }

        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $attivo
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAttivo($attivo)
    {
        if (is_numeric($attivo) ) {
            $this->getQueryBuilder()->andWhere('sezioni.attivo = :attivo ');
            $this->getQueryBuilder()->setParameter('attivo', $attivo);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int|array $moduloId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModuloId($moduloId)
    {
        if (is_numeric($moduloId) ) {
            $this->getQueryBuilder()->andWhere('sezioni.modulo = :moduloId ');
            $this->getQueryBuilder()->setParameter('moduloId', $moduloId);
        }

        if ( is_array($moduloId) ) {
            $this->getQueryBuilder()->andWhere('sezioni.modulo = IN ( :moduloId ) ');
            $this->getQueryBuilder()->setParameter('moduloId', $moduloId);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $slug
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSlug($slug)
    {
        if (is_numeric($slug) ) {
            $this->getQueryBuilder()->andWhere('sezioni.slug = :slug ');
            $this->getQueryBuilder()->setParameter('slug', $slug);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param bool $blocco
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setBlocco($blocco)
    {
        if (is_numeric($blocco) ) {
            $this->getQueryBuilder()->andWhere('sezioni.blocco = :blocco ');
            $this->getQueryBuilder()->setParameter('blocco', $blocco);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $lingua
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLingua($lingua)
    {
        if ( !empty($lingua) ) {
            $this->getQueryBuilder()->andWhere('sezioni.lingua = :lingua ');
            $this->getQueryBuilder()->setParameter('lingua', $lingua);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $abbreviation
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

    /**
     * @param int $isAmmTrasparente
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setIsAmmTrasparente($isAmmTrasparente)
    {
        if ( !empty($isAmmTrasparente) ) {
            $this->getQueryBuilder()->andWhere('sezioni.isAmmTrasparente = 1 ');
        }

        return $this->getQueryBuilder();
    }
}
