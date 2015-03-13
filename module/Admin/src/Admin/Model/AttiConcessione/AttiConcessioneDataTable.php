<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class AttiConcessioneDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $wrapper = $this->setupPaginatorRecords();
        $paginatorRecords = $wrapper->setupRecords();
        
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setTitle('Atti di concessione');
        $this->setDescription('Gestione atti di concessione - amministrazione trapsarente');
        $this->setColumns(array(
                // "key_imp",
                //"Codice",
                "Ufficio-Responsabile del Servizio - Responsabile del Procedimento",
                "Num / Anno",
                "CF / P. IVA Beneficiario",
                "Modalità Assegnazione",
                "Importo",
                "Norma o Titolo a base dell'attribuzione",
                //"Data \ Ora inserimento",
                //"Data scadenza",
                //"Inserito da",
                "",
                "",
                "",
                ""
            )
        );

        $this->setVariables(array(
                'tablesetter' => 'atti-concessione',
                'paginator' => $paginatorRecords,
                'paginatorItemCount' => $wrapper->getPaginator()->getTotalItemCount()
            )
        );
        
        $this->setTemplate('datatable/datatable_atti_concessione.phtml');
        if (!$this->getRecords()) {
            $this->setVariable('messageTitle', 'Nessun atto di concessione presente');
            $this->setVariable('messageDescription', 'Nessun atto di concessione presente in archivio');
        }
    }
    
        /**
         * @return AttiConcessioneGetterWrapper
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $wrapper = new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($this->getInput());
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper;
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
                    
                    //$activeDisableButtonValue = ($row['attivo']!=0) ? 'toDisable' : 'toActive';
            
                    if(isset($row['responsabile'])) {
                        $responsabile = $row['responsabile'];
                    } elseif (isset($row['nomeResp'])) {
                        $responsabile = $row['nomeResp'];
                    }

                    if (!isset($responsabile)) {
                        $responsabile = null;
                    }

                    $arrayToReturn[] = array(
                        // (isset($row['keyImp'])) ? $row['keyImp'] : '',
                        //$row['id'],
                        (isset($responsabile))  ?
                            $row['nomeSezione'].'. <br><br>'.$responsabile
                            :
                            $row['nomeSezione'],
                        
                        $row['progressivo']." / ".$row['anno'],
                        $row['beneficiario'],
                        $row['modassegn'],
                        $row['importo'],
                        $row['titolo'],
                        //$row['dataInserimento'].' <br><br>'.$row['ora'],
                        //$row['scadenza'],
                        //$row['name'].' '.$row['surname'],
                        array(
                            'type'      => $row['attivo']!=0 ? 'activeButton' : 'disableButton',
                            'href'      => '?active=&amp;id='.$row['id'],
                            'value'     => $row['attivo'],
                            'title'     => 'Attiva \ Disattiva'
                        ),
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/atti-concessione/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'title'     => 'Elimina',
                            'data-id'   => $row['id']
                        ),
                        array(
                            'type'      => 'attachButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/attachments/atti-concessione/'.$row['id'],
                            'title'     => 'Gestione allegati'
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}