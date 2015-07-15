<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * Operatori Controller Helper
 */
class OperatoriControllerHelper extends ControllerHelperAbstract
{
    /**
     * Insert azienda into db
     *
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::contrattiPartecipanti,
            array(
                'nome'              => $formData->nome,
                'cf'                => $formData->cf,
                'ragione_sociale'   => $formData->ragioneSociale,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update partecipante into db
     *
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
                'nome'            => $formData->nome,
                'cf'              => $formData->cf,
                'ragione_sociale' => $formData->ragioneSociale,
            ),
            array('id' => $formData->id)
        );
    }

    /**
     * Format Operatori Partecipanti
     *
     * @param array $recordset
     * @param int $excludeAggiudicatari
     * @return array|bool
     */
    public function formatPartecipanti($recordset, $excludeAggiudicatari = 0)
    {
        if (empty($recordset)) {
            return false;
        }

        $partecipanti = array();
        foreach($recordset as $record) {
            if ($excludeAggiudicatari) {
                if ($record['aggiudicatario']!=1) {
                    $partecipanti[] = $record;
                }
            } else {
                if ($record['aggiudicatario']==1) {
                    $partecipanti[] = $record;
                }
            }
        }

        return $partecipanti;
    }

    /**
     * Gather operatori partecipanti IDs
     *
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

    /**
     * Check if Codice Fiscale is valid
     *
     * @param string $cf
     * @return bool
     */
    public function isValidCodiceFiscale($cf)
    {
        if (preg_match("/^[a-z]{6}[0-9]{2}[a-z][0-9]{2}[a-z][0-9]{3}[a-z]$/i", $cf)) {
            return true;
        }

        return false;
    }

    /**
     * Check if Partita IVA is valid
     *
     * @param string $partitaIva
     * @return bool
     */
    public function isValidPartitaIVA($partitaIva)
    {
        if (preg_match("/^[0-9]{11}$/i", $partitaIva)) {
            return true;
        }

        return false;
    }
}