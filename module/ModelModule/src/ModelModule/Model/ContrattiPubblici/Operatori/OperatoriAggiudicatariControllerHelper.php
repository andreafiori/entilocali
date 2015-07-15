<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;

/**
 * Aziende Operatori Aggiudicatari Controller Helper
 */
class OperatoriAggiudicatariControllerHelper extends ControllerHelperAbstract
{
    /**
     * Add operatore to partecipanti's list
     *
     * @param int $partecipanteId
     * @param int $contrattoId
     *
     * @return int
     */
    public function addOperatore($partecipanteId, $contrattoId)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::contrattiRelations,
            array(
                'stato'             => 0,
                'gruppo'            => 0,
                'aggiudicatario'    => 0,
                'membro'            => 0,
                'partecipante_id'   => $partecipanteId,
                'contratto_id'      => $contrattoId,
            )
        );
    }

    /**
     * Delete single relation by ID
     *
     * @param int $id
     * @return int
     */
    public function deleteRelation($id)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::contrattiRelations,
            array('id' => $id)
        );
    }

    /**
     * Update aggiudicatario flag
     *
     * @param int $relationId
     * @param int $aggiudicatarioValue
     *
     * @return int
     */
    public function updateAggiudicatario($relationId, $aggiudicatarioValue)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::contrattiRelations,
            array('aggiudicatario' => $aggiudicatarioValue),
            array('id' => $relationId)
        );
    }

    /**
     * Update gruppo (number)
     *
     * @param int $gruppo
     * @param int $relationId
     *
     * @return int
     */
    public function updateGruppo($gruppo, $relationId)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::contrattiRelations,
            array(
                'gruppo' => $gruppo,
            ),
            array(
                'id' => $relationId,
            )
        );
    }

    /**
     * Update role
     *
     * @param int $role
     * @param int $relationId
     *
     * @return int
     */
    public function updateRole($role, $relationId)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::contrattiRelations,
            array(
                'stato' => $role,
            ),
            array(
                'id' => $relationId,
            )
        );
    }
}