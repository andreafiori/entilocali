<?php

namespace ModelModule\Model\AttiConcessione\ModalitaAssegnazione;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;

/**
 * Modalita Assegnazione Controller Helper
 */
class ModalitaAssegnazioneControllerHelper  extends ControllerHelperAbstract
{
    /**
     * Insert modalita assegnazione into db
     *
     * @param $formData
     *
     * @return string
     */
    public function insert($formData)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::attiConcessioneModAssegn,
            array(
                'nome' => $formData->nome,
                'stato' => null,
                'posizione' => 1,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update modalita assegnazione into db
     *
     * @param $formData
     *
     * @return int
     */
    public function update($formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::attiConcessioneModAssegn,
            array('nome' => $formData->nome),
            array('id' => $formData->id)
        );
    }

    /**
     * Delete modalita assegnazione from db
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::attiConcessioneModAssegn,
            array('id' => $id),
            array('limit' => 1)
        );
    }
}