<?php

namespace ModelModule\Model\Contenuti;

use ModelModule\Model\ControllerHelperAbstract;

class ContenutiControllerHelperAbstract extends ControllerHelperAbstract
{
    /**
     * TODO: refactor for the tree multilevel view
     *
     * @param array $recordset
     * @return array
     */
    public function formatSottoSezioniGetterWrapperRecordsForDropdown($recordset)
    {
        if (!empty($recordset)) {

            $sezioni = array();

            foreach($recordset as $record) {
                if (isset($record['idSottoSezione']) and isset($record['nomeSezione']) and isset($record['nomeSottoSezione'])) {
                    $sezioni[$record['idSottoSezione']] = utf8_encode($record['nomeSezione']).' - '.utf8_encode($record['nomeSottoSezione']);
                }
            }

            return $sezioni;
        }

        return null;
    }
}