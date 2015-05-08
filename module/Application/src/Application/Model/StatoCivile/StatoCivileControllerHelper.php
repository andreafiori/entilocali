<?php

namespace Application\Model\StatoCivile;

use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  18 April 2015
 */
class StatoCivileControllerHelper
{
    /**
     * @var StatoCivileSezioniGetterWrapper
     */
    private $statoCivileSezioniGetterWrapper;

    /**
     * @var StatoCivileGetterWrapper
     */
    private $statoCivileGetterWrapper;

    private $statoCivileYears;

    private $sezioniRecords;

    /**
     * @param StatoCivileSezioniGetterWrapper $statoCivileSezioniGetterWrapper
     */
    public function setStatoCivileSezioniGetterWrapper(StatoCivileSezioniGetterWrapper $statoCivileSezioniGetterWrapper)
    {
        $this->statoCivileSezioniGetterWrapper = $statoCivileSezioniGetterWrapper;
    }

    /**
     * @return StatoCivileSezioniGetterWrapper
     */
    public function getStatoCivileSezioniGetterWrapper()
    {
        return $this->statoCivileSezioniGetterWrapper;
    }

        /**
         * @throws NullException
         */
        private function assertStatoCivileSezioniGetterWrapper()
        {
            if (!$this->getStatoCivileSezioniGetterWrapper()) {
                throw new NullException("StatoCivileSezioniGetterWrapper is not set");
            }
        }

    /**
     * @param array $recordset
     * @return array|bool
     */
    public function formatSezioniForFormSelect(array $recordset)
    {
        if (!empty($recordset)) {

            $arrayToReturn = array();

            foreach($recordset as $record) {

                if (!isset($record['id'])) {
                    break;
                }

                if (isset($record['id']) and isset($record['nome'])) {
                    $arrayToReturn[$record['id']] = $record['nome'];
                }
            }

            return $arrayToReturn;
        }

        return false;
    }

    /**
     * @param array $input
     * @return \Application\Model\QueryBuilderHelperAbstract
     */
    public function setupSezioniRecords($input = array())
    {
        $this->assertStatoCivileSezioniGetterWrapper();

        $this->getStatoCivileSezioniGetterWrapper()->setInput($input);
        $this->getStatoCivileSezioniGetterWrapper()->setupQueryBuilder();

        $this->sezioniRecords = $this->getStatoCivileSezioniGetterWrapper()->getRecords();

        return $this->sezioniRecords;
    }

    /**
     * @return array
     */
    public function getSezioniRecords()
    {
        return $this->sezioniRecords;
    }

    /**
     * @param StatoCivileFormSearch $form
     * @return StatoCivileFormSearch
     */
    public function setupFormSearch(StatoCivileFormSearch $form)
    {
        $sezioni = $this->formatSezioniForFormSelect( $this->getSezioniRecords() );

        $form->addSezioni( !empty($sezioni) ? $sezioni : array() );
        $form->addMesi();
        $form->addAnni();
        $form->addSubmitButton();

        return $form;
    }

    /**
     * @param StatoCivileGetterWrapper $statoCivileGetterWrapper
     */
    public function setStatoCivileGetterWrapper(StatoCivileGetterWrapper $statoCivileGetterWrapper)
    {
        $this->statoCivileGetterWrapper = $statoCivileGetterWrapper;
    }

    /**
     * @return StatoCivileGetterWrapper
     */
    public function getStatoCivileGetterWrapper()
    {
        return $this->statoCivileGetterWrapper;
    }

    /**
     * @param array $input
     * @return array
     */
    public function setupYears($input = array())
    {
        $this->assertStatoCivileGetterWrapper();

        $this->getStatoCivileGetterWrapper()->setInput($input);
        $this->getStatoCivileGetterWrapper()->setupQueryBuilder();

        $this->statoCivileYears = $this->getStatoCivileGetterWrapper()->formatYears(
            $this->getStatoCivileGetterWrapper()->getRecords()
        );
    }

    /**
     * @return array|null
     */
    public function getStatoCivileYears()
    {
        return $this->statoCivileYears;
    }

        /**
         * @throws NullException
         */
        private function assertStatoCivileGetterWrapper()
        {
            if (!$this->getStatoCivileGetterWrapper()) {
                throw new NullException("StatoCivileGetterWrapper is not set");
            }
        }
}
