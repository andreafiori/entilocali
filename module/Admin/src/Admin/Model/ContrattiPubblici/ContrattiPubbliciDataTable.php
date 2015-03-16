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
     * @inheritdoc
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
                "Oggetto del bando",
                "Struttura proponente \ responsabili",
                "Aggiudicatario",
                "Scelta del Contraente",
                // "Elenco degli Operatori invitati a presentare offerte",
                    // "Vedi elenco" (posizione precednete)
                "Numero di offerte ammesse",
                    // "Oggetto del bando", (posizione precednete)
                "Importo somme liquidate Euro",
                "Data di scadenza",
                "Inserito da",
                    // "Vedi Elenco", (pulsante, posizione precedente)
                "Operatori invitati a presentare le offerte",
                "Tempi di completamento",
                "&nbsp;", 
                "&nbsp;",
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
         * @param array $records
         * @return array
         */
        private function getFormattedDataTableRecords($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        "<strong>CIG:</strong> ".$row['cig']."<br><br><strong>Oggetto del bando</strong>: ".$row['titolo']."<br><br><strong>Anno:</strong> ".$row['anno']."<br><br> <strong>Data Contratto:</strong> ",
                        "<strong>CF:</strong> <br><br><strong>Str. prop.:</strong> ".$row['nomeSettore']."<br><br> <strong>Resp. Proc.:</strong> ".$row['nomeResp'],
                        "<br><strong>Data aggiudicazione:</strong> <br><br> <strong>Importo di aggiudicazione (Euro):</strong> ".$row['importoAggiudicazione'],
                        "",
                        "<strong>Procedura di scelta del contraente:</strong>",
                        "",
                        "",
                        $row['name'].' '.$row['surname']." <br><br><strong>Data \ ora di inserimento</strong>: ",
                        "",
                        "<strong>Inizio lavori:</strong> <br><br> <strong>Fine lavori:</strong> ",
                        array(
                            'type'      => 'tableButton',
                            'href'      => $this->getInput('baseUrl',1).'contratti-pubblici-aggiudicatari/elenco/'.$row['id'],
                            'title'     => 'Elenco aggiudicatari \ partecipanti'
                        ),
                        array(
                            'type'      => $row['attivo']!=0 ? 'activeButton' : 'disableButton',
                            'href'      => '#',
                            'value'     => $row['attivo'],
                            'title'     => 'Attiva \ Disattiva'
                        ),
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici/'.$row['id'],
                            'title'     => 'Elimina bando \ contratto',
                            'data-id'   => $row['id']
                        ),
                        array(
                            'type'      => 'attachButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/attachments/contratti-pubblici/'.$row['id'],
                            'title'     => 'Gestione allegati'
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }

        /**
         * @return array
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $wrapper = new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('orderBy'=> 'cc.id DESC') );
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}