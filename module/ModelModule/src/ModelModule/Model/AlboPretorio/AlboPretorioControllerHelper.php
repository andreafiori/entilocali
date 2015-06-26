<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\ControllerHelperAbstract;

class AlboPretorioControllerHelper extends ControllerHelperAbstract
{
    /**
     * Recover progressivo number
     *
     * @param AlboPretorioArticoliGetterWrapper $wrapper
     * @return int
     */
    public function recoverNumeroProgressivo(AlboPretorioArticoliGetterWrapper $wrapper)
    {
        $numeroProgressivo = $this->recoverWrapperRecords(
            $wrapper,
            array(
                'fields'    => 'MAX(alboArticoli.numeroProgressivo) AS maxProgressivo',
                'anno'      => date("Y")
            )
        );

        if (isset($numeroProgressivo[0]['maxProgressivo'])) {
            return $numeroProgressivo[0]['maxProgressivo'] + 1;
        }

        return 1;
    }

    /**
     * Insert articolo into db
     *
     * @param AlboPretorioArticoliFormInputFilter $inputFilter
     * @return int
     * @throws NullException
     */
    public function insert(AlboPretorioArticoliFormInputFilter $inputFilter)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        $this->getConnection()->insert(
            DbTableContainer::alboArticoli,
            array(
                'utente_id'             => $userDetails->id,
                'sezione_id'            => $inputFilter->sezione,
                'numero_progressivo'    => $inputFilter->numeroProgressivo,
                'numero_atto'           => $inputFilter->numeroAtto,
                'anno'                  => $inputFilter->anno,
                'data_attivazione'      => date("Y-m-d H:i:s"),
                'ora_attivazione'       => date("H:i:s"),
                'data_pubblicare'       => date("Y-m-d H:i:s"),
                'ora_pubblicare'        => date("H:i:s"),
                'data_scadenza'         => $inputFilter->dataScadenza,
                'data_pubblicare'       => date("Y-m-d H:i:s"),
                'titolo'                => $inputFilter->titolo,
                'attivo'                => 1,
                'pubblicare'            => 0,
                'annullato'             => 0,
                'check_invia_regione'   => isset($inputFilter->checkInviaRegione) ? $inputFilter->checkInviaRegione : 0,
                'anno_atto'             => date("Y"),
                'ente_terzo'            => $inputFilter->enteTerzo,
                'fonte_url'             => $inputFilter->fonteUrl,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update articolo into db
     *
     * @param AlboPretorioArticoliFormInputFilter $inputFilter
     * @return int
     * @throws NullException
     */
    public function update(AlboPretorioArticoliFormInputFilter $inputFilter)
    {
        $this->assertConnection();
        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        $arrayUpdate = array(
            'utente_id'             => $userDetails->id,
            'sezione_id'            => $inputFilter->sezione,
            'data_pubblicare'       => date("Y-m-d H:i:s"),
            'ora_pubblicare'        => date("H:i:s"),
            'data_scadenza'         => $inputFilter->dataScadenza,
            'data_pubblicare'       => date("Y-m-d H:i:s"),
            'titolo'                => $inputFilter->titolo,
            'attivo'                => 1,
            'check_rettifica'       => isset($inputFilter->checkRettifica) ? $inputFilter->checkRettifica : 0,
            'check_invia_regione'   => isset($inputFilter->checkInviaRegione) ? $inputFilter->checkInviaRegione : 0,
            'anno_atto'             => date("Y"),
            'ente_terzo'            => $inputFilter->enteTerzo,
            'fonte_url'             => $inputFilter->fonteUrl,
            'note'                  => isset($inputFilter->note) ? $inputFilter->note : null,
        );

        /* NOTA: numero e anno non modificabili */
        /*
        if (!empty($inputFilter->numeroAtto)) {
            $arrayUpdate['numero_atto'] = $inputFilter->numeroAtto;
        }

        if (!empty($inputFilter->anno)) {
            $arrayUpdate['anno'] = $inputFilter->anno;
        }
        */

        return $this->getConnection()->update(
            DbTableContainer::alboArticoli,
            $arrayUpdate,
            array('id' => $inputFilter->id)
        );
    }

    /**
     * Delete articolo from db
     *
     * @param int $id
     * @return int
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    public function delete($id)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::alboArticoli,
            array('id' => $id),
            array('limit' => 1)
        );
    }

    /**
     * Check articolo is not annulled
     *
     * @param array $sezioniRecords
     * @throws NullException
     */
    public function checkArticoloIsNotAnnulled($records)
    {
        if (isset($records[0]['annullato']) and $records[0]['annullato']==1) {
            throw new NullException("Articolo annullato. Impossibile modificare l'articolo");
        }
    }
}