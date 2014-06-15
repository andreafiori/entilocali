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
    private $tipo;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        $this->tipo = $param['get']['tipo'];
        
        switch($this->tipo) {
            default: case("contenuto"):
                $this->title        = 'Contenuti';
                $this->description  = 'Gestione contenuti in archivio';
                $this->tipo         = 'content';
            break;

            case("blog"):
                $this->title        = 'Blog posts';
                $this->description  = 'Gestione posts in archivio';
                $this->tipo         = 'blog';
            break;

            case("foto"):
                $this->title        = 'Foto';
                $this->description  = 'Gestione foto in archivio';
                $this->tipo         = 'foto';
            break;
        }
    }
    
    /**
     * @return array 
     */
    public function getColumns()
    {
        return array("Titolo", "Sotto titolo", "Data inserimento", "Ultima modifica", "Stato", "&nbsp;", "&nbsp;", "&nbsp;");
    }
    
    /**
     * @return array 
     */
    public function getRecords()
    {
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager')) );
        $postsGetterWrapper->setInput( array("type" => $this->tipo) );
        $postsGetterWrapper->setupQueryBuilder();
        $postsGetterWrapper->getRecords();
        
        $records = $postsGetterWrapper->getRecords();
        
        $recordsToReturn = array();
        foreach($records as $record) {
            $recordsToReturn[] = array(
                $record['title'],
                $record['subtitle'],
                $this->convertDateTimeToString($record['insertDate']),
                $this->convertDateTimeToString($record['lastUpdate']),
                ucfirst($record['status']),
                array(
                    'type'      => 'updateButton',
                    'href'      => $this->getInput('baseUrl').'formdata/posts/'.$record['postid'],
                    'tooltip'   => 1,
                    'title'     => 'Modifica'
                ),
                array(
                    'type'      => 'deleteButton',
                    'tooltip'   => 1,
                    'title'     => 'Elimina',
                    'data-id'   => $record['postoptionid']
                ),
                '<a href="#" data-toggle="tooltip" data-placement="top" class="btn btn-default btooltip" title="Gestione allegati"><i class="fa fa-paperclip"></i> </a>',
            );
        }

        return $recordsToReturn;
    }
}
