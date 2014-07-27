<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\AlboPretorio\AlboPretorioGetter;
use Admin\Model\AlboPretorio\AlboPretorioGetterWrapper;
use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class AlboPretorioDataTable extends DataTableAbstract implements DataTableInterface
{
    public function getTitle()
    {
        return 'Albo pretorio';
    }
    
    public function getDescription()
    {
        return "Elenco atti albo pretorio";
    }
    
    public function getColumns()
    {
        return array('Num \ Anno', 'Titolo', 'Settore', 'Scadenza', 'Data attivazione', '&nbsp;', '&nbsp;', '&nbsp;' );
    }
    
    public function getRecords()
    {
        $records = $this->getAlboPretorioRecords();
        
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $record) {
                $arrayToReturn[] = array(
                    $record['numeroAtto']." / ".$record['anno'],
                    $record['titolo'],
                    $record['nome'],
                    $record['scadenza'],
                    $this->convertDateTimeToString($record['dataAttivazione']),
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/albo-pretorio/'.$record['id'],
                        'tooltip'   => 1,
                        'title'     => 'Modifica'
                    ),
                    '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" class="btn btn-danger btooltip" title="Relata di pubblicazione"><i class="fa fa-file-pdf-o"></i> </a>',
                    '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" class="btn btn-default btooltip" title="Gestione allegati"><i class="fa fa-paperclip"></i> </a>',
                );
            }
        }
        
        return $arrayToReturn;
    }
        
        private function getAlboPretorioRecords()
        {
            $alboPretorioGetterWrapper = new AlboPretorioGetterWrapper( new AlboPretorioGetter($this->getInput('entityManager',1)) );
            $alboPretorioGetterWrapper->setInput( array( ) );
            $alboPretorioGetterWrapper->setupQueryBuilder();

            return $alboPretorioGetterWrapper->getRecords();
        }
}