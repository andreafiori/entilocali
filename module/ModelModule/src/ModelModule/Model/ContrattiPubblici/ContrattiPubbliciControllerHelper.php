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
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::contratti,
            array(
            'titolo'                    => $formData->titolo,
            'cig'                       => $formData->cig,
            'importo_aggiudicazione'    => $formData->importoAggiudicazione,
            'importo_liquidato'         => $formData->importoLiquidato,
            'scContr'                   => $formData->scContr,
            'respProc'                  => $formData->respProc,
            'inserimento'               => $formData->inserimento,
            'numeroOfferte'             => $formData->numeroOfferte,
        ));
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
            'scContr'                   => $formData->scContr,
            'respProc'                  => $formData->respProc,
            'inserimento'               => $formData->inserimento,
            'numeroOfferte'             => $formData->numeroOfferte,
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
}