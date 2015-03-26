<?php

namespace Admin\Model\Sezioni;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  24 March 2015
 */
class SezioniPositionsHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $wrapper = new SezioniGetterWrapper(new SezioniGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput(array(
            'fields'  => 'sezioni.id, sezioni.nome, sezioni.colonna, sezioni.posizione',
            'blocco'  => 1,
            'attivo'  => 1,
            'orderBy' => 'sezioni.posizione'
        ));
        $wrapper->setupQueryBuilder();

        $sezioniRecords = $wrapper->formatRecordsPerColumn($wrapper->getRecords());

        $this->setVariables(array(
            'records' => $sezioniRecords,
        ));

        $this->setTemplate('sezioni/positions.phtml');
    }
}