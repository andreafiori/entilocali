<?php

namespace Admin\Model\Sezioni;

use Admin\Model\ControllerHelperAbstract;
use Application\Model\NullException;

abstract class SezioniControllerHelperAbstract extends ControllerHelperAbstract
{
    protected $sezioniGetterWrapper;

    protected $sottoSezioniGetterWrapper;

    protected $sottoSezioniGetterWrapperRecords;

    /**
     * @throws NullException
     */
    protected function assertSezioniGetterWrappper()
    {
        if (!$this->getSezioniGetterWrapper()) {
            throw new NullException("SezioniGetterWrapper is not set");
        }
    }

    /**
     * @param SottoSezioniGetterWrapper $sottoSezioniGetterWrapper
     */
    public function setSottoSezioniGetterWrapper(SottoSezioniGetterWrapper $sottoSezioniGetterWrapper)
    {
        $this->sottoSezioniGetterWrapper = $sottoSezioniGetterWrapper;
    }

    /**
     * @return SottoSezioniGetterWrapper
     */
    public function getSottoSezioniGetterWrapper()
    {
        return $this->sottoSezioniGetterWrapper;
    }

    /**
     * @param SezioniGetterWrapper $sezioniGetterWrapper
     */
    public function setSezioniGetterWrapper(SezioniGetterWrapper $sezioniGetterWrapper)
    {
        $this->sezioniGetterWrapper = $sezioniGetterWrapper;
    }

    /**
     * @return SezioniGetterWrapper
     */
    public function getSezioniGetterWrapper()
    {
        return $this->sezioniGetterWrapper;
    }

    /**
     * @param array $sottoSezioniGetterWrapperRecords
     */
    public function setSottoSezioniGetterWrapperRecords(array $sottoSezioniGetterWrapperRecords)
    {
        $this->sottoSezioniGetterWrapperRecords = $sottoSezioniGetterWrapperRecords;
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

    /**
     * @throws NullException
     */
    protected function assertSottoSezioniGetterWrapper()
    {
        if (!$this->getSottoSezioniGetterWrapper()) {
            throw new NullException("SottoSezioniGetterWrapper is not set");
        }
    }

    /**
     * @throws NullException
     */
    protected function assertSottoSezioniGetterWrapperRecords()
    {
        $sottoSezioniRecords = $this->getSottoSezioniGetterWrapperRecords();
        if ( empty($sottoSezioniRecords) ) {
            throw new NullException("SottoSezioniGetterWrapperRecords are not set or empty");
        }
    }
}
