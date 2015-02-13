<?php

namespace Admin\Model\Posts;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class PostsDataTable extends DataTableAbstract
{
    private $type;
    
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getParam();
        
        switch($param['route']['tablesetter']) {
            default: case("contents"):
                $this->title        = 'Contenuti';
                $this->description  = 'Gestione contenuti in archivio';
                $this->type         = 'content';
            break;

            case("blog"):
                $this->title        = 'Blog posts';
                $this->description  = 'Gestione posts in archivio';
                $this->type         = 'blog';
            break;

            case("photo"):
                $this->title        = 'Foto';
                $this->description  = 'Gestione foto in archivio';
                $this->type         = 'foto';
            break;
        }
        
        $this->setColumns( array(
            "Titolo", 
            "Inserito il", 
            "Ultima modifica", 
            "Stato", 
            "&nbsp;", 
            "&nbsp;", 
            "&nbsp;"
            ) 
        );
        
        $paginatorRecords = $this->getRecordsPaginator();
        
        $this->setVariable('paginator',     $paginatorRecords);
        $this->setVariable('tablesetter',   $param['route']['tablesetter']);
        $this->setTemplate('datatable/datatable_posts.phtml');
        $this->setRecords($this->getFormattedRecords($paginatorRecords));
    }
    
    /**
     * @param array $records
     * @return array
     */
    public function getFormattedRecords($records)
    {
        $recordsToReturn = array();
        foreach($records as $record) {
            $recordsToReturn[] = array(
                $record['title'],
                $record['insertDate'],
                $record['lastUpdate'],
                ucfirst($record['status']),
                array(
                    'type'      => 'updateButton',
                    'href'      => $this->getInput('baseUrl',1).'formdata/posts/'.$record['postid'],
                    'tooltip'   => 1,
                    'title'     => 'Modifica'
                ),
                array(
                    'type'      => 'deleteButton',
                    'tooltip'   => 1,
                    'title'     => 'Elimina',
                    'data-id'   => $record['postoptionid']
                ),
                array(
                    'type'      => 'attachButton',
                    'href'      => '#',
                    'tooltip'   => 1,
                ),
            );
        }

        return $recordsToReturn;
    }
    
        /**
         * @return array
         */
        private function getRecordsPaginator()
        {
            $param = $this->getParam();
            
            $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager')) );
            $postsGetterWrapper->setInput( array("type" => $this->type) );
            $postsGetterWrapper->setupQueryBuilder();
            $postsGetterWrapper->setupPaginator($postsGetterWrapper->setupQuery( $this->getInput('entityManager', 1) ));
            $postsGetterWrapper->setupPaginatorCurrentPage(isset($param['route']['page']) ? $param['route']['page'] : null);
            $postsGetterWrapper->setupPaginatorItemsPerPage(isset($param['route']['perpage']) ? $param['route']['perpage'] : null);

            return $postsGetterWrapper->getPaginator();
        }
}
