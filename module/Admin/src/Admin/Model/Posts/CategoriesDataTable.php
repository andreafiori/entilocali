<?php

namespace Admin\Model\Posts;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class CategoriesDataTable extends DataTableAbstract
{
    public function getColumns()
    {
        return array("Nome", "Data creazione", "Stato", "&nbsp;", "&nbsp;");
    }
    
    public function getRecords()
    {
        $param = $this->getInput('param',1);
        $moduleId = $param['get']['moduleId'];
        $moduleRecord = $this->getInput('moduleRecord', 1);

        $this->title        = 'Categorie '.$moduleRecord[$moduleId];
        $this->description  = 'Modifica dati categorie '.$moduleRecord[$moduleId];
        
        $categoriesGetterWrapper = new CategoriesGetterWrapper( new CategoriesGetter($this->getInput('entityManager',1)) );
        $categoriesGetterWrapper->setInput( array("moduleId" => $moduleId) );
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
                    'href'      => $this->getInput('baseUrl').'formdata/categories/'.$record['module'].'/'.$record['id'],
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
