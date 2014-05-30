<?php

namespace Admin\Model\Categorie;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\DataTable\DataTableInterface;
use Application\Model\Categorie\CategorieGetter;
use Application\Model\Categorie\CategorieGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class CategorieDataTable extends DataTableAbstract implements DataTableInterface
{
    private $categorieGetterWrapper;
    
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        
        $this->title = 'Categorie';
        $this->description = 'Modifica dati categorie';
    }
    
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
        return array("Nome", "Stato", "&nbsp;", "&nbsp;");
    }
    
    public function getRecords()
    {
        $categorieGetterWrapper = new CategorieGetterWrapper( new CategorieGetter($this->getInput('entityManager',1)) );
        $categorieGetterWrapper->setInput( array("moduloId" => 4) );
        $categorieGetterWrapper->setupQueryBuilder();
        
        $records = $categorieGetterWrapper->getRecords();
        
        $recordsToReturn = array();
        foreach($records as $record) {
            $recordsToReturn[] = array(
                $record['nome'],
                $record['status'],
                '<a href="'.$this->getInput('baseUrl').'formdata/categorie/'.$record['postid'].'" title="Modifica"><i class="fa fa-pencil"></i> Modifica</a>', 
                '<a href="#" title="Elimina"><i class="fa fa-times"></i> Elimina</a>',
            );
        }

        return $recordsToReturn;
        
        return array( array("nome"=>'prova','stato'=>'attivo','modifica','elimina') );
    }
}
