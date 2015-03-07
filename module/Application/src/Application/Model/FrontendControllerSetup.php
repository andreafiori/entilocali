<?php

namespace Application\Model;

use Admin\Model\Sezioni\SezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  04 March 2015
 */
class FrontendControllerSetup extends ControllerSetupAbstract
{
    /**
     * @var SezioniGetterWrapper
     */
    private $sezioniGetterWrapper;

    /**
     * @param SezioniGetterWrapper $wrapper
     * @return SezioniGetterWrapper
     */
    public function setupSezioniGetterWrapper(SezioniGetterWrapper $wrapper)
    {
        $this->sezioniGetterWrapper = $wrapper;

        return $this->sezioniGetterWrapper;
    }

    /**
     * @param array $input
     *
     * @return QueryBuilderHelperAbstract
     *
     * @throws NullException
     */
    public function setupSezioniRecords($input = array())
    {
        $this->assertSezioniGetterWrapper();

        $this->sezioniGetterWrapper->setInput($input);
        $this->sezioniGetterWrapper->setupQueryBuilder();

        return $this->sezioniGetterWrapper->getRecords();
    }

    /**
     * @param array $records
     * @param array $input
     *
     * @return array
     */
    public function setupSottoSezioniRecords(array $records, $input = array())
    {
        $this->assertSezioniGetterWrapper();

        return $this->sezioniGetterWrapper->addSottoSezioni($records,  $input);
    }

    /**
     * @param array $sezioniRecords
     * @return array
     */
    public function sortByColumn(array $sezioniRecords)
    {
        $sezioni = array();
        foreach($sezioniRecords as $sezione) {
            if (isset($sezione['colonna'])) {
                $sezioni[$sezione['colonna']][] = $sezione;
            }
        }

        return $sezioni;
    }

        /**
         * @throws NullException
         */
        private function assertSezioniGetterWrapper()
        {
            if (!isset($this->sezioniGetterWrapper)) {
                throw new NullException('SezioniGetterWrapper object is not set');
            }
        }
}