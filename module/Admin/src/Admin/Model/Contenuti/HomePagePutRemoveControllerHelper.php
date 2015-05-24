<?php

namespace Admin\Model\Contenuti;

use Admin\Model\ControllerHelperAbstract;
use Application\Model\Database\DbTableContainer;
use Application\Model\NullException;

class HomePagePutRemoveControllerHelper extends ControllerHelperAbstract
{
    private $contenutiGetterWrapper;

    private $contenutiRecords;

    /**
     * @param mixed $contenutiGetterWrapper
     */
    public function setContenutiGetterWrapper($contenutiGetterWrapper)
    {
        $this->contenutiGetterWrapper = $contenutiGetterWrapper;
    }

    /**
     * @return mixed
     */
    public function getContenutiGetterWrapper()
    {
        return $this->contenutiGetterWrapper;
    }

    /**
     * @throws NullException
     */
    private function assertContenutiGetterWrapper()
    {
        if (!$this->getContenutiGetterWrapper()) {
            throw new NullException("ContenutiGetterWrapper is not set");
        }
    }

    /**
     * @param array $input
     */
    public function setupContenutiRecords($input = array())
    {
        $this->assertContenutiGetterWrapper();

        $this->contenutiRecords = $this->recoverWrapperRecords(
            $this->getContenutiGetterWrapper(),
            $input
        );
    }

    /**
     * @throws NullException
     */
    public function checkContenutiRecords()
    {
        if (!$this->getContenutiRecords()) {
            throw new NullException("Dati relativi ai contenuti non trovati durante un'interrogazione sull'archivio");
        }
    }

    /**
     * @return array
     */
    public function getContenutiRecords()
    {
        return $this->contenutiRecords;
    }

    /**
     * @param $id
     * @param int $home
     * @param int $attivo
     * @throws NullException
     */
    public function updateContenutiHome($id, $home = 1)
    {
        $this->assertConnection();

        $this->getConnection()->update(
            DbTableContainer::contenuti,
            array(
                'home' => $home,
            ),
            array('id' => $id)
        );
    }

    /**
     * @param $id
     * @param $blockId
     */
    public function deleteFromHomePage($id, $blockId)
    {
        $this->assertConnection();

        $this->getConnection()->delete(
            DbTableContainer::homepage,
            array(
                'reference_id'  => $id,
                'block_id'      => $blockId,
            )
        );
    }
}