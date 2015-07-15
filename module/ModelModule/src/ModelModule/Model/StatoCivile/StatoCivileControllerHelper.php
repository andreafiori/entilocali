<?php

namespace ModelModule\Model\StatoCivile;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * Stato Civile Controller Helper
 */
class StatoCivileControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param StatoCivileGetterWrapper $wrapper
     * @return int
     */
    public function recoverNumeroProgressivo(StatoCivileGetterWrapper $wrapper)
    {
        $numeroProgressivo = $this->recoverWrapperRecords(
            $wrapper,
            array(
                'fields'    => 'MAX(sca.progressivo) AS maxProgressivo',
                'anno'      => date("Y")
            )
        );

        if (isset($numeroProgressivo[0]['maxProgressivo'])) {
            return $numeroProgressivo[0]['maxProgressivo'] + 1;
        }

        return 1;
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        $this->getConnection()->insert(
            DbTableContainer::statoCivileArticoli,
            array(
                'titolo'                => $formData->titolo,
                'progressivo'           => $formData->progressivo,
                'anno'                  => date("Y"),
                'data'                  => date("Y-m-d"),
                'ora'                   => date("H:i:s"),
                'attivo'                => $formData->attivo,
                'scadenza'              => $formData->scadenza,
                'utente_id'             => $userDetails->id,
                'sezione_id'            => $formData->sezione,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $arrayUpdate = array(
            'titolo'                => $formData->titolo,
            'anno'                  => date("Y"),
            'data'                  => date("Y-m-d"),
            'ora'                   => date("H:i:s"),
            'attivo'                => $formData->attivo,
            'scadenza'              => $formData->scadenza,
            'sezione_id'            => $formData->sezione,
            'homepage_flag'         => isset($formData->homepageFlag) ? $formData->homepageFlag : 0,
            'box_notizie'           => isset($formData->boxNotizie) ? $formData->boxNotizie : 0,
        );

        if (isset($formData->utente)) {
            $arrayUpdate['utente_id'] = $formData->utente;
        }

        return $this->getConnection()->update(
            DbTableContainer::statoCivileArticoli,
            $arrayUpdate,
            array('id' => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function delete($id)
    {
        return $this->getConnection()->delete(
            DbTableContainer::statoCivileArticoli,
            array('id' => $id),
            array('limit' => 1)
        );
    }

    /**
     * @param StatoCivileGetterWrapper $wrapper
     * @param array $input
     * @return array
     */
    public function setupYears(StatoCivileGetterWrapper $wrapper, $input = array())
    {
        $wrapper->setInput($input);

        $wrapper->setupQueryBuilder();

        return $wrapper->formatYears( $wrapper->getRecords() );
    }
}
