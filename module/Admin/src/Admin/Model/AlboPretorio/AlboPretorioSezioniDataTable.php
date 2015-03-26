<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class AlboPretorioSezioniDataTable extends DataTableAbstract implements DataTableInterface
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->setTitle('Sezioni albo pretorio');

        $this->setDescription('Elenco sezioni albo pretorio.');

        $this->setVariables(array(
            'tablesetter' => 'albo-pretorio-sezioni',
            'columns'     => array(
                "Nome",
                "Stato",
                "&nbsp;",
                "&nbsp;",
            ),
        ));
    }
    
    /**
     * @return array|null
     */
    public function getRecords()
    {
        return $this->formatRecords(
            $this->recoverRecords(
                new AlboPretorioSezioniGetterWrapper(
                    new AlboPretorioSezioniGetter($this->getInput('entityManager',1))
                )
            )
        );
    }

    /**
     * Recover albo sezioni records from db
     *
     * @param AlboPretorioSezioniGetterWrapper $alboPretorioGetterWrapper
     * @param array $input
     *
     * @return \Application\Model\QueryBuilderHelperAbstract
     */
    public function recoverRecords(AlboPretorioSezioniGetterWrapper $alboPretorioGetterWrapper, $input = array())
    {
        $alboPretorioGetterWrapper->setInput($input);
        $alboPretorioGetterWrapper->setupQueryBuilder();

        return $alboPretorioGetterWrapper->getRecords();
    }

    /**
     * Format recors to show on the view
     *
     * @param array $records
     * @return array
     */
    public function formatRecords(array $records)
    {
        if (is_array($records)) {
            $arrayToReturn = array();
            foreach($records as $record) {
                $arrayToReturn[] = array(
                    $record['nome'],
                    ($record['attivo']==1) ? 'Attivo' : 'Nascosto',
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/albo-pretorio-sezioni/'.$record['id'],
                        'title'     => 'Modifica'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $record['id'],
                        'title'     => 'Elimina'
                    ),
                );
            }
        }

        return $arrayToReturn;
    }
}
