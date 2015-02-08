<?php

namespace Admin\Model\Sezioni;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     *@var SezioniGetter
     */
    protected $objectGetter;

    /**
     * @param SezioniGetter $objectGetter
     */
    public function __construct(SezioniGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setColonna( $this->getInput('colonna', 1) );
        $this->objectGetter->setAttivo( $this->getInput('attivo', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }

    /**
     * @param array $records
     */
    public function addSottoSezioni(array $records)
    {
        foreach($records as &$record) {
            switch($record['moduleCode']) {
                default:
                    $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->objectGetter->getEntityManager()) );
                    $wrapper->setInput( array(
                            'sezioneId' => $record['id'],
                            'orderBy'   => 'sottosezioni.posizione',
                            'isSs'      => 0
                        )
                    );
                    $wrapper->setupQueryBuilder();

                    $record['sottosezioni'] = is_array($wrapper->getRecords()) ? $wrapper->getRecords() : null;
                break;
                
                case("eventi"):
                    
                break;

                /* 
                case("albo"): case("albo-pretorio"):
                    $wrapper = new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter($this->objectGetter->getEntityManager()) );
                    $wrapper->setInput( array(
                            'fields'    => 'DISTINCT(aps.id) AS idSezione, aps.nome',
                            'annullato' => 0,
                            'attivo'    => 1,
                            'pubblicare'=> 1,
                        )
                    );
                    $wrapper->setupQueryBuilder();
                    $records = $wrapper->getRecords();
                break;
                
                
            
                case("contratti-pubblici"):
                    
                break;
                
                case("community"):
                    
                break;
                */
            }
        }

        return $records;
    }
    
    /**
     * Setup column sezioni
     * 
     * @param array $records
     */
    public function setupColumn(array $records)
    {
        
    }
}
