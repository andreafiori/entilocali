<?php

namespace ModelModule\Model\ContrattiPubblici;

use ModelModule\Model\Users\RespProc\UsersRespProcGetterWrapper;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;
use ModelModule\Model\NullException;

class ContrattiPubbliciFormControllerHelper
{
    private $sceltaContraenteGetterWrapper;

    private $sceltaContraenteRecords;

    private $usersRespProcGetterWrapper;

    private $usersRespProcRecords;

    /**
     * @param SceltaContraenteGetterWrapper $wrapper
     */
    public function setSceltaContraenteGetterWrapper(SceltaContraenteGetterWrapper $wrapper)
    {
        $this->sceltaContraenteGetterWrapper = $wrapper;
    }

    public function setupSceltaContraenteRecords($input = array())
    {
        $this->assertSceltaContraenteGetterWrapper();

        $this->getSceltaContraenteGetterWrapper()->setInput($input);
        $this->getSceltaContraenteGetterWrapper()->setupQueryBuilder();

        $this->sceltaContraenteRecords = $this->getSceltaContraenteGetterWrapper()->getRecords();
    }

    public function checkSceltaContraenteRecords()
    {
        $records = $this->getSceltaContraenteRecords();
        if ( empty($records) ) {
            throw new NullException("Nessuna opzione di scelta contraente rilevata");
        }
    }

    public function formatSceltaContraenteRecords()
    {
        $this->checkSceltaContraenteRecords();

        $records = $this->getSceltaContraenteRecords();

        $recordContainer = array();
        foreach($records as $record) {
            if ( isset($record['id']) and isset($record['nomeScelta']) ) {
                $recordContainer[$record['id']] = $record['nomeScelta'];
            }
        }

        $this->sceltaContraenteRecords = $recordContainer;
    }

    /**
     * @return mixed
     */
    public function getSceltaContraenteGetterWrapper()
    {
        return $this->sceltaContraenteGetterWrapper;
    }

    /**
     * @return array|null
     */
    public function getSceltaContraenteRecords()
    {
        return $this->sceltaContraenteRecords;
    }

    /**
     * @param UsersRespProcGetterWrapper $wrapper
     */
    public function setUsersRespProcGetterWrapper(UsersRespProcGetterWrapper $wrapper)
    {
        $this->usersRespProcGetterWrapper = $wrapper;
    }

    /**
     * @return UsersRespProcGetterWrapper
     */
    public function getUsersRespProcGetterWrapper()
    {
        return $this->usersRespProcGetterWrapper;
    }

    /**
     * @return array|null
     */
    public function getUsersRespProcRecords()
    {
        return $this->usersRespProcRecords;
    }

    /**
     * @param array $input
     */
    public function setupUsersRespProcRecords($input = array())
    {
        $this->assertUsersRespProcGetterWrapper();

        $this->getUsersRespProcGetterWrapper()->setInput($input);
        $this->getUsersRespProcGetterWrapper()->setupQueryBuilder();

        $this->usersRespProcRecords = $this->getUsersRespProcGetterWrapper()->getRecords();
    }

    public function checkUsersRespProcRecords()
    {
        $records = $this->getUsersRespProcRecords();
        if ( empty($records) ) {
            throw new NullException("Nessuna responsabile di procedimento rilevato");
        }
    }

    public function formatUsersRespProcRecords()
    {
        $this->checkUsersRespProcRecords();

        $records = $this->getUsersRespProcRecords();

        $recordContainer = array();
        foreach($records as $record) {
            if ( isset($record['name']) and isset($record['surname']) ) {
                $recordContainer[$record['id']] = $record['name'].' '.$record['surname'];
            }
        }

        $this->usersRespProcRecords = $recordContainer;
    }

        /**
         * @throws NullException
         */
        private function assertUsersRespProcGetterWrapper()
        {
            if (!$this->getUsersRespProcGetterWrapper()) {
                throw new NullException("UsersRespProcGetterWrapper is not set");
            }
        }

        /**
         * @throws NullException
         */
        private function assertSceltaContraenteGetterWrapper()
        {
            if (!$this->getSceltaContraenteGetterWrapper()) {
                throw new NullException("SceltaContraenteGetterWrapper is not set");
            }
        }
}