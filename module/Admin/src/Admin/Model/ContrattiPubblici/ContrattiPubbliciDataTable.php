<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  26 June 2014
 */
class ContrattiPubbliciDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $paginatorRecords = $this->setupPaginatorRecords();
        
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setVariable('tablesetter', 'contratti-pubblici');
        $this->setVariable('paginator', $paginatorRecords);

        $this->setTitle('Contratti pubblici');
        $this->setDescription('Gestione bandi contratti pubblici');
        $this->setColumns(array(
                "Bando",
                "Struttura Proponente",
                "Procedura di scelta del contraente",
                "Operatori invitati a presentare le offerte",
                "Aggiudicatario",
                "Importi",
                "Tempi di completamento",
                /*
                "Id",
                "Anno",
                "CIG",
                "Struttura proponente \ Responsabile del Servizio \ Responsabile del Procedimento",
                "Aggiudicatario",
                "Data Aggiudicazione",
                "Data Contratto",
                "Scelta del Contraente",
                "Importo di aggiudicazione (Euro)",
                "Elenco degli Operatori invitati a presentare offerte",
                "Numero di offerte ammesse",
                "Oggetto del bando",
                "Importo somme liquidate Euro",
                "Data di inserimento",
                "Ora di inserimento",
                "Data di scadenza",
                "Inserito da",
                "Vedi Elenco",
                */
                "&nbsp;", 
                "&nbsp;",
                "&nbsp;"
            )
        );
        
        $this->setTemplate('datatable/datatable_contratti_pubblici.phtml');
        if (!$this->getRecords()) {
            $this->setVariable('messageTitle', 'Nessun bando di contratto presente');
            $this->setVariable('messageDescription', 'Nessun articolo o bando di contratto presente in archivio');
        }
        
    }
    
        /**
         * @return array
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $contrattiPubbliciGetterWrapper = new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($this->getInput('entityManager',1)) );
            $contrattiPubbliciGetterWrapper->setInput($this->getInput());
            $contrattiPubbliciGetterWrapper->setupQueryBuilder(); 
            $contrattiPubbliciGetterWrapper->setupPaginator( $contrattiPubbliciGetterWrapper->setupQuery($this->getInput('entityManager', 1)) );
            $contrattiPubbliciGetterWrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $contrattiPubbliciGetterWrapper->setupRecords();
        }
        
        /**
         * @param array $records
         * @return array
         */
        private function getFormattedDataTableRecords($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        "<strong>CIG:</strong> ".$row['cig']."<br><br><strong>Oggetto del bando</strong>: ".$row['titolo']."<br><br><strong>Anno:</strong> ".$row['anno']."",
                        "",
                        "",
                        "",
                        "",
                        "",
                        "",
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici/'.$row['id'],
                            'tooltip'   => 1,
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici/'.$row['id'],
                            'title'     => 'Elimina',
                            'data-id'   => $row['id']
                        ),
                        array(
                            'type'      => 'attachButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici/'.$row['id'],
                            'title'     => 'Elimina'
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}