<?php

namespace ModelModule\Model\AttiConcessione;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class AttiConcessioneControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        return $this->getConnection()->insert(
            DbTableContainer::attiConcessione,
            array(
                'titolo'                => $formData->titolo,
                'beneficiario'          => $formData->beneficiario,
                'importo'               => $formData->importo,
                'ufficioresponsabile'   => $formData->ufficioResponsabile,
                'progressivo'           => $formData->progressivo,
                'mod_assegnazione_id'   => $formData->modAssegnazione,
                'data'                  => $formData->dataInserimento,
                'anno'                  => $formData->anno,
                'settore_id'            => $formData->ufficioResponsabile,
                'resp_proc_id'          => $formData->respProc,
                'utente_id'             => $userDetails->id,
            )
        );
    }

    /**
     * @param AttiConcessioneGetterWrapper $wrapper
     * @return int
     */
    public function recoverNumeroProgressivo(AttiConcessioneGetterWrapper $wrapper, $anno)
    {
        $numeroProgressivo = $this->recoverWrapperRecords(
            $wrapper,
            array(
                'fields'    => 'MAX(atti.progressivo) AS maxProgressivo',
                'anno'      => $anno
            )
        );

        if (isset($numeroProgressivo[0]['maxProgressivo'])) {
            return $numeroProgressivo[0]['maxProgressivo'] + 1;
        }

        return 1;
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $arrayToUpdate = array(
            'titolo'                => $formData->titolo,
            'beneficiario'          => $formData->beneficiario,
            'importo'               => $formData->importo,
            'mod_assegnazione_id'   => $formData->modAssegnazione,
            'data'                  => $formData->dataInserimento,
            'anno'                  => $formData->anno,
            'settore_id'            => $formData->ufficioResponsabile,
            'resp_proc_id'          => $formData->respProc,
        );

        if (isset($formData->utente)) {
            $arrayToUpdate['utente_id'] = $formData->utente;
        }

        return $this->getConnection()->update(
            DbTableContainer::attiConcessione,
            $arrayToUpdate,
            array('id'    => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * @param $recordset
     * @return array
     */
    public function formatResponsabiliForDropdown($recordset)
    {
        if (is_array($recordset)) {

            $responsabiliProcedimento = array();

            foreach($recordset as $record) {
                if (isset($record['name']) and isset($record['surname'])) {
                    $responsabiliProcedimento[$record['id']] = $record['name'].' '.$record['surname'];
                }
            }

            return $responsabiliProcedimento;
        }

        return null;
    }

    /**
     * @param array $years
     * @return array
     */
    public function formatYears($years)
    {
        if (!empty($years)) {

            $yearsForDropdown = array();
            foreach($years as $year) {
                if (isset($year['year'])) {
                    $yearsForDropdown[$year['year']] = $year['year'];
                }
            }

            return $yearsForDropdown;
        }

        return false;
    }
}