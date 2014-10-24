<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\InputSetupAbstract;

/**
 * @author Andrea Fiori
 * @since  01 August 2014
 */
class AlboPretorioRecordsGetterWrapper extends InputSetupAbstract
{
    private $alboPretorioRecords;
    
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->setAlboPretorioRecords( new AlboPretorioRecords() );
    }
    
    /**
     * @param \Admin\Model\AlboPretorio\AlboPretorioRecords $alboPretorioRecords
     */
    public function setAlboPretorioRecords(AlboPretorioRecords $alboPretorioRecords)
    {
        $this->alboPretorioRecords = $alboPretorioRecords;
    }
    
    public function getAlboPretorioRecords()
    {
        return $this->alboPretorioRecords;
    }
}
