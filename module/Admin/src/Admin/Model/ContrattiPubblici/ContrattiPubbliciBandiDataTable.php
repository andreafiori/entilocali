<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  26 June 2014
 */
class ContrattiPubbliciBandiDataTable extends DataTableAbstract
{
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->title        = 'Bandi contratti pubblici';
        $this->description  = 'Gestione bandi contratti pubblici';
    }
    /**
     * @return array 
     */
    public function getColumns()
    {
        return array(
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
                "&nbsp;", "&nbsp;", "&nbsp;");
    }
    
    /**
     * @return array 
     */
    public function getRecords()
    {
        return array( array("asdasdd", "asdsaasdsd", "asdaasdasdasd") );
    }
}