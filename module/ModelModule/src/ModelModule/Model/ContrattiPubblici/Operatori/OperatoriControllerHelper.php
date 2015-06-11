<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class OperatoriControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::contrattiPartecipanti,
            array(
                'nome'              => $formData->nome,
                'cf'                => $formData->cf,
                'ragione_sociale'    => $formData->ragioneSociale,
            )
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     * @throws \ModelModule\Model\NullException
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::contrattiPartecipanti,
            array(
                'nome'              => $formData->nome,
                'cf'                => $formData->cf,
                'ragione_sociale'    => $formData->ragioneSociale,
            ),
            array(
                'id' => $formData->id
            )
        );
    }

    /**
     * @param array $recordset
     * @param int $excludeAggiudicatari
     * @return array|bool
     */
    public function formatPartecipanti($recordset, $excludeAggiudicatari = 0)
    {
        if (empty($recordset)) {
            return false;
        }

        $aggiudicatari = array();
        foreach($recordset as $record) {
            if ($excludeAggiudicatari) {
                if ($record['aggiudicatario']!=1) {
                    $aggiudicatari[] = $record;
                }
            } else {
                if ($record['aggiudicatario']==1) {
                    $aggiudicatari[] = $record;
                }
            }
        }

        return $aggiudicatari;
    }

    /**
     * @param array $recordset
     * @return array|bool
     */
    public function gatherPartecipantiId($recordset)
    {
        if (empty($recordset)) {
            return false;
        }

        $container = array();
        foreach($recordset as $record) {
            if (isset($record['idPartecipante'])) {
                $container[] = $record['idPartecipante'];
            }
        }

        return $container;
    }
}