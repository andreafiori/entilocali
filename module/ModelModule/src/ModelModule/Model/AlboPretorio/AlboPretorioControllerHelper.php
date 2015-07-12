<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\ControllerHelperAbstract;

/**
 * Albo Pretorio Controller Helper
 */
class AlboPretorioControllerHelper extends ControllerHelperAbstract
{
    /**
     * Insert atto into db
     *
     * @param AlboPretorioArticoliFormInputFilter $inputFilter
     *
     * @return int
     */
    public function insert(AlboPretorioArticoliFormInputFilter $inputFilter)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        if ( is_numeric($inputFilter->numeroGiorniScadenza) ) {
            $dataScadenza = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s"). ' + '.$inputFilter->numeroGiorniScadenza.' days'));
        } else {
            $dataScadenza = $inputFilter->dataScadenza;
        }

        $this->getConnection()->insert(
            DbTableContainer::alboArticoli,
            array(
                'utente_id'             => $userDetails->id,
                'sezione_id'            => $inputFilter->sezione,
                'numero_progressivo'    => 0,
                'numero_atto'           => $inputFilter->numeroAtto,
                'anno'                  => $inputFilter->anno,
                'data_attivazione'      => '0000-00-00',
                'ora_attivazione'       => '00:00:00',
                'data_pubblicare'       => '0000-00-00',
                'ora_pubblicare'        => '00:00:00',
                'data_scadenza'         => $dataScadenza,
                'data_pubblicare'       => date("Y-m-d H:i:s"),
                'titolo'                => $inputFilter->titolo,
                'attivo'                => 0,
                'pubblicare'            => 0,
                'annullato'             => 0,
                'check_invia_regione'   => isset($inputFilter->checkInviaRegione) ? $inputFilter->checkInviaRegione : 0,
                'anno_atto'             => date("Y"),
                'ente_terzo'            => $inputFilter->enteTerzo,
                'fonte_url'             => $inputFilter->fonteUrl,
                'data_rettifica'        => '0000-00-00 00:00:00',
                'data_annullamento'     => '0000-00-00 00:00:00',
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
            'data_rettifica'        => isset($inputFilter->checkRettifica) ? date("Y-m-d H:i:s") : '0000-00-00 00:00:00',
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
     *
     * @return int
     *
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

    /**
     * Update publiccare flag, update date and hour
     *
     * @param int $id
     *
     * @return bool
     */
    public function publishArticle($id, $progressivo)
    {
        $this->assertConnection();

        return  $this->getConnection()->update(
            DbTableContainer::alboArticoli,
            array(
                'numero_progressivo'    => $progressivo,
                'pubblicare'            => 1,
                'attivo'                => 1,
                'annullato'             => 0,
                'data_pubblicare'       => date("Y-m-d"),
                'ora_pubblicare'        => date("H:i:s"),
            ),
            array('id' => $id)
        );
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function annullArticle($id)
    {
        $this->assertConnection();

        $this->getConnection()->update(
            DbTableContainer::alboArticoli,
            array(
                'annullato'         => 1,
                'data_annullamento' => date("Y-m-d H:i:s"),
            ),
            array('id' => $id)
        );

        return true;
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function activeAtto($id)
    {
        $this->getConnection();

        return $this->getConnection()->update(
            DbTableContainer::alboArticoli,
            array(
                'attivo'            => 1,
                'data_attivazione'  => date("Y-m-d H:i:s"),
                'ora_attivazione'   => date("H:i:s"),
            ),
            array('id' => $id)
        );
    }

    /**
     * Recover progressivo number
     *
     * @param AlboPretorioArticoliGetterWrapper $wrapper
     *
     * @return int
     */
    public function recoverNumeroProgressivo(AlboPretorioArticoliGetterWrapper $wrapper, $anno)
    {
        $numeroProgressivo = $this->recoverWrapperRecords(
            $wrapper,
            array(
                'fields'    => 'MAX(alboArticoli.numeroProgressivo) AS maxProgressivo',
                'anno'      => $anno
            )
        );

        if (isset($numeroProgressivo[0]['maxProgressivo'])) {
            return $numeroProgressivo[0]['maxProgressivo'] + 1;
        }

        return 1;
    }

    /**
     * @param array $sessionSearch
     * @return array
     */
    public function recoverArrayQuerySearch($sessionSearch)
    {
        return array(
            'freeSearch'        => isset($sessionSearch['testo']) ? $sessionSearch['testo'] : null,
            'sezioneId'         => isset($sessionSearch['sezine']) ? $sessionSearch['sezine'] : null,
            'numeroProgressivo' => isset($sessionSearch['numero_progressivo']) ? $sessionSearch['numero_progressivo'] : null,
            'numeroAtto'        => isset($sessionSearch['numero_atto']) ? $sessionSearch['numero_atto'] : null,
            'mese'              => isset($sessionSearch['mese']) ? $sessionSearch['mese'] : null,
            'anno'              => isset($sessionSearch['anno']) ? $sessionSearch['anno'] : null,
            'home'              => isset($sessionSearch['home']) ? $sessionSearch['home'] : null,
            'orderBy'           => 'alboArticoli.id DESC'
        );
    }
}