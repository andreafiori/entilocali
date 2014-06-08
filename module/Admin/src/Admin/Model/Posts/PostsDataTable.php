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
    protected $tipo;

    /**
     * 
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        $this->tipo = $param['get']['type'];
        
        switch($this->tipo) {
            default: case("contenuto"):
                $this->title = 'Contenuti';
                $this->description = 'Gestione contenuti in archivio';
                $this->tipo = 'content';
            break;

            case("blog"):
                $this->title = 'Blog posts';
                $this->description = 'Gestione posts in archivio';
                $this->tipo = 'blog';
            break;

            case("foto"):
                $this->title = 'Foto';
                $this->description = 'Gestione foto in archivio';
                $this->tipo = 'foto';
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
    
    /**
     * @return array 
     */
    public function getColumns()
    {
        return array("Titolo", "Sotto titolo", "Data inserimento", "Ultima modifica", "Stato", "&nbsp;", "&nbsp;", "&nbsp;", "&nbsp;");
    }
    
    /**
     * @return array 
     */
    public function getRecords()
    {
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager')) );
        $postsGetterWrapper->setInput( array("tipo" => $this->tipo) );
        $postsGetterWrapper->setupQueryBuilder();
        $postsGetterWrapper->getRecords();
        
        $records = $postsGetterWrapper->getRecords();
        
        $recordsToReturn = array();
        foreach($records as $record) {
            $recordsToReturn[] = array(
                $record['titolo'],
                $record['sottotitolo'],
                $this->convertDateTimeToString($record['dataInserimento']),
                $this->convertDateTimeToString($record['dataUltimoAggiornamento']),
                ucfirst($record['stato']),
                '<a href="'.$this->getInput('baseUrl').'formdata/posts/'.$record['postid'].'" data-toggle="tooltip" data-placement="top" class="btn btn-primary btooltip" title="Modifica"><i class="fa fa-pencil"></i> </a>', 
                '<a href="#addBookDialog" data-id="'.$record['postoptionid'].'" class="open-AddBookDialog btn btn-danger btooltip" data-toggle="tooltip" data-placement="top" title="Elimina"><i class="fa fa-times"></i> </a>',
                '<a href="#" data-toggle="tooltip" data-placement="top" class="btn btn-default btooltip" title="Gestione allegati"><i class="fa fa-paperclip"></i> </a>',
                '<a href="#" data-toggle="tooltip" data-placement="top" class="btn btn-default btooltip" title="Categorie"><i class="fa fa-arrows"></i> </a>'
            );
        }

        return $recordsToReturn;
    }

        /**
         * @param \DateTime $dateTime
         * @return type
         */
        private function convertDateTimeToString(\DateTime $dateTime)
        {
            if($dateTime instanceof \DateTime){
                return $dateTime->format('d-m-Y');
            }
        }
}
