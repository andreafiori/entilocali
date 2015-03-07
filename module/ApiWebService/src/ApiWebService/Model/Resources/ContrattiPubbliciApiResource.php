<?php

namespace ApiWebService\Model\Resources;

use ApiWebService\Model\ApiResultGetterAbstract;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  05 March 2015
 */
class ContrattiPubbliciApiResource extends ApiResultGetterAbstract
{
    /**
     * @param array $input
     * @return array
     */
    public function getResourceRecords(array $input)
    {
        $wrapper = new ContrattiPubbliciGetterWrapper( new ContrattiPubbliciGetter($this->getEntityManager()) );
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($this->getEntityManager()) );
        $wrapper->setupPaginatorCurrentPage($this->getPage());
        $wrapper->setupPaginatorItemsPerPage($this->getPerPage());

        $paginator = $wrapper->getPaginator();

        $arrayToReturn = array();
        $arrayToReturn['metadata'] = array(
            'titolo'                            => 'Pubblicazione legge 190 anno 1',
            'abstract'                          => 'Pubblicazione legge 190 anno 1 rif.',
            'dataPubbicazioneDataset'          => '2015-03-04',
            'entePubblicatore'                  => 'Comune di Telti',
            'dataUltimoAggiornamentoDataset'    => '2015-03-04',
            'annoRiferimento'                   => '2015',
            'urlFile'                           => 'http://www.comune.telti.ot.it/xml/dataset.xml',
            'licenza'                           => 'IODL',
        );
        foreach($paginator as $row) {
            $arrayToReturn[] = $row;
        }

        return $arrayToReturn;
    }
}