<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * TODO: get data from db, buttons: edit, delete (only for admin), invia ad altro ente
 * 
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class StatoCivileDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);       
        
        $this->title        = 'Stato civile';
        $this->description  = 'Gestione atti stato civile in archivio';
    }
    
    /**
     * @return array 
     */
    public function getColumns()
    {
        return array("Titolo", "Numero / Anno", "Sezione", "Inserito il", "Scadenza", "Da", "&nbsp;", "&nbsp;", "&nbsp;");
    }
    
    /**
     * @return array 
     */
    public function getRecords()
    {  
        return array(
            array("prova", "1 / 2014", "sezione prova", "20/10/2013", "20/10/2030", 'Andrea Fiori', '', '', ''),
            array("prova 2", "2 / 2014", "sezione prova", "20/10/2013", "20/10/2030", 'Andrea Fiori', '', '', ''),
            array("prova 3", "3 / 2014", "sezione prova", "20/10/2013", "20/10/2030", 'Andrea Fiori', '', '', ''),
        );
    }
}
