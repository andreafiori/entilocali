<?php

namespace Admin\Model\Posts;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\DataTable\DataTableInterface;
use Application\Model\Posts\PostsGetter;
use Application\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class PostsDataTable extends DataTableAbstract implements DataTableInterface
{
    protected $title, $description;
    
    protected $tipo;

    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        $this->tipo = $param->fromQuery('type');
        
        switch($this->tipo) {
            default: case("contant"):
                $this->title = 'Contenuti';
                $this->description = 'Gestione contenuti in archivio';
                $this->tipo = 'content';
            break;

            case("blog"):
                $this->title = 'Blog posts';
                $this->description = 'Gestione posts in archivio';
            break;

            case("foto"):
                $this->title = 'Foto';
                $this->description = 'Gestione foto in archivio';
            break;
        }
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
        return array("Titolo", "&nbsp;", "&nbsp;", "&nbsp;", "&nbsp;");
    }
    
    public function getRecords()
    {
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager')) );
        $postsGetterWrapper->setInput( array("tipo" => $this->tipo) );
        $postsGetterWrapper->setPostsGetterQueryBuilder();
        $postsGetterWrapper->getRecords();
        
        $records = $postsGetterWrapper->getRecords();
        
        $recordsToReturn = array();
        foreach($records as $record) {
            $recordsToReturn[] = array(
                $record['titolo'],
                //'<a href="#" title="Modifica categoria '.$record['nomeCategoria'].'">'.$record['nomeCategoria'].'</a>',
                '<a href="'.$this->getInput('baseUrl').'formdata/posts/'.$record['postid'].'" title="Modifica"><i class="fa fa-pencil"></i> Modifica</a>', 
                '<a href="#" title="Elimina"><i class="fa fa-times"></i> Elimina</a>',
                '<a href="#" title="Gestione allegati"><i class="fa fa-paperclip"></i> Allegati</a>',
                '<a href="#" title="Gestione allegati">Relazioni</a>'
            );
        }

        return $recordsToReturn;
    }
}
