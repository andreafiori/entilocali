<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  08 July 2014
 */
class AlboPretorioGetterWrapper extends RecordsGetterWrapperAbstract
{
    private $alboPretorio;

    /**
     * @param \Admin\Model\Posts\PostsGetter $postsGetter
     */
    public function __construct(PostsGetter $postsGetter)
    {
        $this->alboPretorioGetter = $postsGetter;
    }
    
    public function setupQueryBuilder()
    {
        $this->alboPretorio->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->alboPretorio->setMainQuery();
        
        $this->alboPretorio->setId( $this->getInput('id', 1) );
        //$this->alboPretorio->setOrderBy( $this->getInput('orderby', 1) );
        //$this->alboPretorio->setLimit( $this->getInput('limit', 1) );
    }
}

