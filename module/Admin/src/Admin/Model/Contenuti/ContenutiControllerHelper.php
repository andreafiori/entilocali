<?php

namespace Admin\Model\Contenuti;

use Admin\Model\ControllerHelperAbstract;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Model\NullException;

class ContenutiControllerHelper extends ControllerHelperAbstract
{
    private $contenutiGetterWrapper;

    private $contenutiGetterWrapperRecords;

    private $sottoSezioniGetterWrapper;

    private $sottoSezioniGetterWrapperRecords;

    /**
     * @param ContenutiGetterWrapper $contenutiGetterWrapper
     */
    public function setContenutiGetterWrapper(ContenutiGetterWrapper $contenutiGetterWrapper)
    {
        $this->contenutiGetterWrapper = $contenutiGetterWrapper;
    }

    /**
     * @return ContenutiGetterWrapper
     */
    public function getContenutiGetterWrapper()
    {
        return $this->contenutiGetterWrapper;
    }

    /**
     * @param ContenutiGetterWrapper $contenutiGetterWrapperRecords
     */
    public function setContenutiGetterWrapperRecords(ContenutiGetterWrapper $contenutiGetterWrapperRecords)
    {
        $this->contenutiGetterWrapperRecords = $contenutiGetterWrapperRecords;
    }

    /**
     * @return mixed
     */
    public function getContenutiGetterWrapperRecords()
    {
        return $this->contenutiGetterWrapperRecords;
    }

    /**
     * @param array $input
     * @throws NullException
     */
    public function setupContenutiGetterWrapperRecords($input = array())
    {
        $this->assertContenutiGetterWrapper();

        $this->contenutiGetterWrapperRecords = $this->recoverWrapperRecords(
            $this->getContenutiGetterWrapper(),
            $input
        );
    }

    /**
     * @param array $input
     * @param $page
     * @throws NullException
     */
    public function setupContenutiGetterWrapperRecordsPaginator($input = array(), $page)
    {
        $this->assertContenutiGetterWrapper();

        $this->contenutiGetterWrapperRecords = $this->recoverWrapperRecordsPaginator(
            $this->getContenutiGetterWrapper(),
            $input,
            $page
        );
    }

    /**
     * @param SottoSezioniGetterWrapper $sottoSezioniGetterWrapper
     */
    public function setSottoSezioniGetterWrapper(SottoSezioniGetterWrapper $sottoSezioniGetterWrapper)
    {
        $this->sottoSezioniGetterWrapper = $sottoSezioniGetterWrapper;
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
     * @throws NullException
     */
    private function assertSottoSezioniGetterWrapper()
    {
        if (!$this->getSottoSezioniGetterWrapper()) {
            throw new NullException("SottoSezioniGetterWrapper is not set");
        }
    }

    /**
     * @throws NullException
     */
    private function assertSottoSezioniGetterWrapperRecords()
    {
        $sottoSezioniRecords = $this->getSottoSezioniGetterWrapperRecords();
        if ( empty($sottoSezioniRecords) ) {
            throw new NullException("SottoSezioniGetterWrapperRecords are not set or empty");
        }
    }

    /**
     * @return mixed
     */
    public function getSottoSezioniGetterWrapper()
    {
        return $this->sottoSezioniGetterWrapper;
    }

    /**
     * @return array
     */
    public function getSottoSezioniGetterWrapperRecords()
    {
        return $this->sottoSezioniGetterWrapperRecords;
    }

    /**
     * @param array $input
     */
    public function setupSottoSezioniGetterWrapperRecords($input = array())
    {
        $this->assertSottoSezioniGetterWrapper();

        $this->sottoSezioniGetterWrapperRecords = $this->recoverWrapperRecords(
            $this->getSottoSezioniGetterWrapper(),
            $input
        );
    }

    /**
     * @param array $records
     */
    public function formatSottoSezioniGetterWrapperRecordsForDropdown($recordsInput = array())
    {
        $this->assertSottoSezioniGetterWrapperRecords();

        $records = ( empty($recordsInput) ) ? $this->getSottoSezioniGetterWrapperRecords() : $recordsInput;

        $sezioni = array();
        foreach($records as $record) {
            if (isset($record['idSottoSezione']) and isset($record['nomeSezione']) and isset($record['nomeSottoSezione'])) {
                $sezioni[$record['idSottoSezione']] = utf8_encode($record['nomeSezione']).' - '.utf8_encode($record['nomeSottoSezione']);
            }
        }

        $this->sottoSezioniGetterWrapperRecords = $sezioni;
    }

}
