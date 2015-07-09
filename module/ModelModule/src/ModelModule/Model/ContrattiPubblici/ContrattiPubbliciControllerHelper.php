<?php

namespace ModelModule\Model\ContrattiPubblici;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class ContrattiPubbliciControllerHelper extends ControllerHelperAbstract
{
    /**
     * Insert contratto into db
     *
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function insert(ContrattiPubbliciFormInputFilter $formData)
    {
        $this->assertConnection();
        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        $this->getConnection()->insert(
            DbTableContainer::contratti,
            array(
                'beneficiario'              => isset($formData->beneficiario) ? $formData->beneficiario : '',
                'titolo'                    => $formData->titolo,
                'numero_determina'          => $formData->numeroDetermina,
                'data_determina'            => $formData->dataDetermina,
                'importo_aggiudicazione'    => $formData->importoAggiudicazione,
                'importo_liquidato'         => $formData->importoLiquidato,
                'operatori'                 => null,
                'numero_offerte'            => $formData->numeroOfferte,
                'data_inizio_lavori'        => $formData->dataInizioLavori,
                'data_fine_lavori'          => $formData->dataFineLavori,
                'progressivo'               => (isset($formData->progressivo)) ? $formData->progressivo : 1,
                'anno'                      => (isset($formData->anno)) ? $formData->anno : date("Y"),
                'data_inserimento'          => date("Y-m-d"),
                'ora_inserimento'           => date("H:i:s"),
                'attivo'                    => 0,
                'scadenza'                  => date('Y-m-d', strtotime('+5 years')),
                'modalita_assegnazione'     => isset($formData->modalitaAssegnazione) ? $formData->modalitaAssegnazione : 1,
                'cig'                       => $formData->cig,
                'homepage'                  => 0,
                'data_ultimo_aggiornamento' => date("Y-m-d H:i:s"),
                'utente_id'                 => $userDetails->id,
                'settore_id'                => $formData->settoreId,
                'sc_contr_id'               => $formData->sceltaContraenteId,
                'resp_proc_id'              => $formData->respProcId,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update contratto on db
     *
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $arrayToUpdate = array(
            'titolo'                    => $formData->titolo,
            'cig'                       => $formData->cig,
            'importo_aggiudicazione'    => $formData->importoAggiudicazione,
            'importo_liquidato'         => $formData->importoLiquidato,
            'sc_contr_id'               => $formData->sceltaContraenteId,
            'resp_proc_id'              => $formData->respProcId,
            'data_ultimo_aggiornamento' => date("Y-m-d H:i:s"),
        );

        if (isset($formData->utente)) {
            $arrayToUpdate['utente_id'] = $formData->utente;
        }

        return $this->getConnection()->update(
            DbTableContainer::contratti,
            $arrayToUpdate,
            array('id'    => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * Update attivo flag to hide or show contratto on public website
     *
     * @param int $id
     * @param int $attivo
     */
    public function updateAttivo($id, $attivo = 0)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::contratti,
            array('attivo' => $attivo),
            array('id'    => $id),
            array('limit' => 1)
        );
    }

    public function updateHome($id, $home = 0)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::contratti,
            array('home' => $home),
            array('id'    => $id),
            array('limit' => 1)
        );
    }

    /**
     * @param array $recordset
     * @return array|null
     */
    public function formatUsersRespProcRecords($recordset)
    {
        if (!empty($recordset)) {

            $container = array();

            foreach($recordset as $record) {
                if ( isset($record['name']) and isset($record['surname']) ) {
                    $container[$record['id']] = $record['name'].' '.$record['surname'];
                }
            }

            return $container;
        }

        return null;
    }

    public function checkUsersRespProcRecords()
    {
        $records = $this->getUsersRespProcRecords();
        if ( empty($records) ) {
            throw new NullException();
        }
    }
}