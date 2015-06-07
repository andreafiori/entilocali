<?php

namespace ModelModule\Model\EntiTerzi;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class EntiTerziControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::entiTerzi,
            array(
                'nome'        => $formData->nome,
                'email'       => $formData->email,
                'insert_date' => date("Y-m-d H:i:s"),
                'last_update' => date("Y-m-d H:i:s"),
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

        return $this->getConnection()->update(
            DbTableContainer::entiTerzi,
            array(
                'nome'        => $formData->nome,
                'email'       => $formData->email,
                'last_update' => date("Y-m-d H:i:s"),
            ),
            array('id' => $formData->id)
        );
    }
}