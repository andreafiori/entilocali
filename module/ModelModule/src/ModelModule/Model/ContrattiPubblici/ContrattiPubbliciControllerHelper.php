<?php

namespace ModelModule\Model\ContrattiPubblici;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class ContrattiPubbliciControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function insert(ContrattiPubbliciFormInputFilter $formData)
    {
        $this->assertConnection();
        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        return $this->getConnection()->insert(
            DbTableContainer::contratti,
            array(
                'beneficiario'              => $formData->beneficiario,
                'titolo'                    => $formData->titolo,
                'numero_determina'          => $formData->numeroDetermina,
                'data_determina'            => $formData->data_determina,
                'operatori'                 => $formData->operatori,
                'numero_offerte'            => $formData->numeroOfferte,
                'data_inizio_lavori'        => $formData->dataInizioLavori,
                'data_fine_lavori'          => $formData->dataFineLavori,
                'progressivo'               => $formData->progressivo,
                'anno'                      => $formData->anno,
                'data'                      => $formData->data,
                'ora'                       => $formData->ora,
                'attivo'                    => 1,
                'scadenza'                  => $formData->scadenza,
                'modalita_assegnazione'     => $formData->scadenza,
                'cig'                       => $formData->cig,
                'homepage'                  => 0,
                'data_ultimo_aggiornamento' => date("Y-m-d H:i:s"),
                'utente_id'                 => $userDetails->id,
                'settore_id'                => $userDetails->settore,


                'importo_aggiudicazione'    => $formData->importoAggiudicazione,
                'importo_liquidato'         => $formData->importoLiquidato,
                'sc_contr_id'               => $formData->sceltaContraenteId,
                'resp_proc_id'              => $formData->respProcId,

            )
        );
    }

    /**
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