<?php

namespace Admin\Model\AlboPretorio;

use ModelModule\Model\NullException;

class AlboPretorioControllerHelper
{
    private $alboPretorioArticoliGetterWrapper;

    private $alboPretorioArticoliRecords;

    /**
     * @param AlboPretorioArticoliGetterWrapper $wrapper
     */
    public function setAlboPretorioArticoliGetterWrapper(AlboPretorioArticoliGetterWrapper $wrapper)
    {
        $this->alboPretorioArticoliGetterWrapper = $wrapper;
    }

    /**
     * @return AlboPretorioArticoliGetterWrapper
     */
    public function getAlboPretorioArticoliGetterWrapper()
    {
        return $this->alboPretorioArticoliGetterWrapper;
    }

    /**
     * @param array $input
     * @throws NullException
     */
    public function setupAlboPretorioArticoliRecords($input = array())
    {
        $this->assertAlboPretorioArticoliGetterWrapper();

        $wrapper = $this->getAlboPretorioArticoliGetterWrapper();

        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        $this->alboPretorioArticoliRecords = $wrapper->getRecords();
    }

    /**
     * @throws NullException
     */
    private function assertAlboPretorioArticoliGetterWrapper()
    {
        if (!$this->getAlboPretorioArticoliGetterWrapper()) {
            throw new NullException("AlboPretorioArticoliGetterWrapper object is not set");
        }
    }

    /**
     * @return array
     */
    public function getAlboPretorioArticoliRecords()
    {
        return $this->alboPretorioArticoliRecords;
    }
}