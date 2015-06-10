<?php

namespace ModelModule\Model\ContrattiPubblici\SceltaContraente;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class SceltaContraenteControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::contrattiSceltaContraente,
            array(
                'nome_scelta'   => $formData->nomeScelta,
                'attivo'        => $formData->attivo,
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
            DbTableContainer::contrattiSceltaContraente,
            array(
                'nome_scelta'   => $formData->nomeScelta,
                'attivo'        => $formData->attivo,
            ),
            array('id' => $formData->id)
        );
    }
}