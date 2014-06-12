<?php

namespace Admin\Model\Categories;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\Categories\CategoriesGetter;
use Admin\Model\Categories\CategoriesGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class CategoriesDataTable extends DataTableAbstract implements DataTableInterface
{
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getColumns()
    {
        return array("Nome", "Data creazione", "Stato", "&nbsp;", "&nbsp;");
    }
    
    public function getRecords()
    {
        $param = $this->getInput('param',1);
        $moduloId = $param['get']['moduloId'];
        $moduleRecord = $this->getInput('moduleRecord', 1);
        
        $this->title        = 'Categorie '.$moduleRecord[$moduloId];
        $this->description  = 'Modifica dati categorie'.$moduleRecord[$moduloId];
        
        $categoriesGetterWrapper = new CategoriesGetterWrapper( new CategoriesGetter($this->getInput('entityManager',1)) );
        $categoriesGetterWrapper->setInput( array("moduloId" => $moduloId) );
        $categoriesGetterWrapper->setupQueryBuilder();
        
        $records = $categoriesGetterWrapper->getRecords();
        
        $recordsToReturn = array();
        foreach($records as $record) {
            $recordsToReturn[] = array(
                $record['name'],
                $this->convertDateTimeToString($record['createDate']),
                ucfirst($record['status']),
                array(
                    'type'      => 'updateButton',
                    'href'      => $this->getInput('baseUrl').'formdata/categories/'.$record['id'],
                    'tooltip'   => 1,
                    'title'     => 'Modifica'
                ),
                array(
                    'type'      => 'deleteButton',
                    'tooltip'   => 1,
                    'title'     => 'Elimina',
                    'data-id'   => $record['id']
                ),
            );
        }

        return $recordsToReturn;
    }
}
