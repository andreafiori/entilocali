<?php

namespace ModelModule\Model\Sezioni;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\NullException;

abstract class SezioniControllerHelperAbstract extends ControllerHelperAbstract
{
    /**
     * @var SezioniGetterWrapper
     */
    protected $sezioniGetterWrapper;

    protected $sezioniGetterWrapperRecords;

    /**
     * @var SottoSezioniGetterWrapper
     */
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
     * @throws NullException
     */
    protected function assertSezioniGetterWrapper()
    {
        if (!$this->getSezioniGetterWrapper()) {
            throw new NullException("SezioniGetterWrapper is not set");
        }
    }

    /**
     * @return mixed
     */
    public function getSezioniGetterWrapperRecords()
    {
        return $this->sezioniGetterWrapperRecords;
    }

    /**
     * @param array $input
     */
    public function setupSezioniGetterWrapperRecords($input = array())
    {
        $this->assertSezioniGetterWrapper();

        $this->sezioniGetterWrapperRecords = $this->recoverWrapperRecords(
            $this->getSezioniGetterWrapper(),
            $input
        );
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
    public function assertSottoSezioniGetterWrapperRecords()
    {
        $sottoSezioniRecords = $this->getSottoSezioniGetterWrapperRecords();
        if ( empty($sottoSezioniRecords) ) {
            throw new NullException("Nessuna sottosezione in archivio");
        }
    }
}
