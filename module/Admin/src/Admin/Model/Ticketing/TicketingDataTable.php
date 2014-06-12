<?php

namespace Admin\Model\Ticketing;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\DataTable\DataTableInterface;

/**
 * @author Andrea Fiori
 * @since  18 May 2013
 */
class TicketingDataTable extends DataTableAbstract implements DataTableInterface
{
    public function getTitle()
    {
        return 'Assistenza';
    }
    
    public function getDescription()
    {
        return 'Consulta le assistenze in archivio';
    }
    
    public function getColumns()
    {
        return array("app", "browser", "so", "");
    }
    
    public function getRecords()
    {
        return array(
            array("Trident", "Internet Explorer 4.0", "Win 95+", "4"),
            array("Trident", "Internet Explorer 4.0", "Win 95+", "4"),
            array("Trident", "Internet Explorer 4.0", "Win 95+", "4"),
            array("Trident", "Internet Explorer 4.0", "Win 95+", "4"),
            array("Trident", "Internet Explorer 4.0", "Win 95+", "4"),
            array("Trident", "Internet Explorer 4.0", "Win 95+", "4"),
            array("Trident", "Internet Explorer 4.0", "Win 95+", "4"),
        );
    }
}
