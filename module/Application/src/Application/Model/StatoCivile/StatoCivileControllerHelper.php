<?php

namespace Application\Model\StatoCivile;

use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
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
}
