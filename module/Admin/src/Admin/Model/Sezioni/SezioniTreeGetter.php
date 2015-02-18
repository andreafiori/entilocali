<?php

namespace Admin\Model\Sezioni;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class SezioniTreeGetter
{
    private $wrapper;
    private $arrayTree;
    private $percorso = array();

    /**
     * @param SottoSezioniGetterWrapper $wrapper
     */
    public function __construct(SottoSezioniGetterWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
        
    }

    public function setupTree()
    {
        $wrapper = $this->wrapper;
        $wrapper->setInput(array(
            'orderBy'   => 'sezioni.colonna DESC, sezioni.posizione, sezioni.nome, sottosezioni.posizione, sottosezioni.nome',
            'modulo'    => 2,
        ));
        $wrapper->setupQueryBuilder();

        $records = $wrapper->getRecords();
        if ( is_array($records) ) {
            foreach($records as $record) {
                $percorso = $record['nomeSezione'].' -> '.$record['nomeSottosezione'];
                
                $this->percorso[$record['idSottosezione']] = $percorso;
                
                $this->setupRecursively($record['idSottosezione'], $percorso);
            }
        }

        return $this->percorso;
    }
        
        /**
         * Setup sections recursively
         * 
         * @param int $profondita
         * @param string $percorso
         */
        private function setupRecursively($profondita, $percorso)
        {
            $wrapper = $this->wrapper;
            $wrapper->setInput(array(
                'profonditaDa' => $profondita
            ));
            $wrapper->setupQueryBuilder();
            $records = $wrapper->getRecords();

            if (is_array($records)) {
                foreach($records as $record) {

                    $this->percorso[$record['idSottosezione']] = $record['nomeSezione'].' -> '.$record['nomeSottosezione'];
                    
                    // $this->setupRecursively($record['idSottosezione'], $percorso);
                }
            }
            
            return $this->percorso;
        }
}

