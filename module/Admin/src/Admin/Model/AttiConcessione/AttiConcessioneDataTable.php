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
        $paginatorItemCount = $wrapper->getPaginator()->getTotalItemCount();
        
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setTitle('Atti di concessione');

        $this->setDescription('Gestione <strong>'.$paginatorItemCount.'</strong> atti di concessione in archivio');

        $this->setColumns(array(
                "Ufficio-Responsabile del Servizio - Responsabile del Procedimento",
                "Num / Anno",
                "CF / P. IVA Beneficiario",
                "Modalità Assegnazione",
                "Importo",
                "Norma o Titolo a base dell'attribuzione",
                "",
                "",
                "",
                "",
            )
        );

        $this->setVariables(array(
                'tablesetter'           => 'atti-concessione',
                'paginator'             => $paginatorRecords,
                'paginatorItemCount'    => $paginatorItemCount
            )
        );

        $this->setTemplate('datatable/datatable_atti_concessione.phtml');

        if (!$this->getRecords()) {
            $this->setVariables(array(
                'messageTitle'       => 'Nessun atto di concessione presente',
                'messageDescription' => 'Nessun atto di concessione presente in archivio',
                )
            );
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

                    if(isset($row['responsabile'])) {
                        $responsabile = $row['responsabile'];
                    } elseif (isset($row['nomeResp'])) {
                        $responsabile = $row['nomeResp'];
                    }

                    if (!isset($responsabile)) {
                        $responsabile = null;
                    }

                    $arrayToReturn[] = array(
                        (isset($responsabile))  ?
                            utf8_encode($row['nomeSezione']).'. <br><br>'.$responsabile
                            :
                            utf8_encode($row['nomeSezione']),
                        $row['progressivo']." / ".$row['anno'],
                        utf8_encode($row['beneficiario']),
                        utf8_encode($row['nomemodAssegnazione']),
                        utf8_encode($row['importo']),
                        utf8_encode($row['titolo']),
                        '<strong>Data inserimento:</strong> '.$row['dataInserimento'].' <br><br><strong>Scadenza:</strong> '.$row['scadenza'].'<br><br> <strong>Inserito da:</strong> '.$row['name'].' '.$row['surname'],
                        array(
                            'type'      => ($row['attivo']!=0) ? 'toDisable' : 'toActive',
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
                            'data-id'   => $row['id'],
                        ),
                        array(
                            'type'      => 'attachButton',
                            'href'      => $this->getInput('baseUrl', 1).'formdata/attachments/atti-concessione/'.$row['id'],
                            'title'     => 'Gestione allegati',
                        ),
                    );
                }
            }

            return $arrayToReturn;
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
}