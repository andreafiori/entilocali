<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\Users\UsersGetterWrapper;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  09 April 2015
 */
class AlboPretorioFormControllerHelper
{
    /**
     * @param AlboPretorioArticoliGetterWrapper $recodsGetter
     * @param int $id
     *
     * @return array|null
     */
    public function recoverAlboArticolo(AlboPretorioArticoliGetterWrapper $recodsGetter, $id)
    {
        if (is_numeric($id)) {
            $recodsGetter->setInput( array('id' => $id, 'limit' => 1) );
            $recodsGetter->setupQueryBuilder();

            return $recodsGetter->getRecords();
        }

        return null;
    }

    /**
     * @param UsersGetterWrapper $recodsGetter
     * @return array
     */
    public function recoverUsersRecords(UsersGetterWrapper $recodsGetter)
    {
        $recodsGetter->setInput( array('fields' => 'u.id,u.name,u.surname') );
        $recodsGetter->setupQueryBuilder();

        return $recodsGetter->getRecords();
    }

    /**
     * @param AlboPretorioSezioniGetterWrapper $recodsGetter
     * @return array
     */
    public function recoverSezioniRecords(AlboPretorioSezioniGetterWrapper $recodsGetter)
    {
        $recodsGetter->setInput(array());
        $recodsGetter->setupQueryBuilder();

        return $recodsGetter->getRecords();
    }

    /**
     * @param $records
     * @return array
     */
    public function formatSezioniForADropdown(array $records)
    {
        $toReturn = array();

        if (!empty($records)and isset($record['id']) and isset($record['nome'])) {
            foreach($records as $record) {
                $toReturn[$record['id']] = $record['nome'];
            }
        }

        return $toReturn;
    }

    /**
     * @param $sezioniRecords
     * @throws NullException
     */
    public function checkSezioniIsNotEmpty($sezioniRecords)
    {
        if (empty($sezioniRecords)) {
            $nullException = new NullException();
            $nullException->setParams(array(
                'type'  => 'danger',
                'title' => 'Sezioni albo pretorio non presenti',
                'text'  => 'Sezioni non presenti o non rilevate dal sistema. Verificare i dati delle sezioni o inserirne una nuova',
            ));
            throw $nullException;
        }
    }

    /**
     * @param $sezioniRecords
     * @throws NullException
     */
    public function checkArticoloIsNotAnnull($records)
    {
        if (isset($records[0]['annullato']) and $records[0]['annullato']==1) {
            $nullException = new NullException();
            $nullException->setParams(array(
                'type'  => 'warning',
                'title' => 'Articolo annullato',
                'text'  => "Articolo annullato. Impossibile modificare l'articolo.",
            ));
            throw $nullException;
        }
    }
}