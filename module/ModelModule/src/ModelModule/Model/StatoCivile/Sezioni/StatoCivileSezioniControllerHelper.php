<?php

namespace ModelModule\Model\StatoCivile\Sezioni;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class StatoCivileSezioniControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     * @throws \ModelModule\Model\NullException
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::statoCivileSezioni,
            array(
                'nome'                         => $formData->nome,
                'attivo'                       => $formData->attivo,
                'data_inserimento'             => date("Y-m-d H:i:s"),
                'data_ultimo_aggiornamento'    => date("Y-m-d H:i:s"),
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
            DbTableContainer::statoCivileSezioni,
            array(
                'nome'                         => $formData->nome,
                'attivo'                       => $formData->attivo,
                'data_ultimo_aggiornamento'    => date("Y-m-d H:i:s"),
            ),
            array('id' => $formData->id),
            array('limit' => 1)
        );
    }

    public function delete($id)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::statoCivileSezioni,
            array('id' => $id),
            array('limit' => 1)
        );
    }
}
