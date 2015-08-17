<?php

namespace ModelModule\Model\Contenuti;

use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Slugifier;

/**
 * Contenuti Controller Helper
 */
class ContenutiControllerHelper extends ContenutiControllerHelperAbstract
{
    /**
     * Insert contenuto on db
     *
     * @param InputFilterAwareInterface $inputFilter
     * @param string $moduleName
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $inputFilter, $moduleName = 'contenuti')
    {
        $this->assertConnection();
        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        $arrayUpdate = array(
            'sottosezione_id'   => $inputFilter->sottosezione,
            'titolo'            => $inputFilter->titolo,
            'sommario'          => $inputFilter->sommario,
            'testo'             => $inputFilter->testo,
            'data_inserimento'  => $inputFilter->dataInserimento,
            'data_scadenza'     => $inputFilter->dataScadenza,
            'attivo'            => $inputFilter->attivo,
            'slug'              => Slugifier::slugify($inputFilter->titolo),
            'home'              => $inputFilter->home,
            'rss'               => $inputFilter->rss,
            'utente_id'         => $userDetails->id
        );

        $this->getConnection()->insert(
            DbTableContainer::contenuti,
            $arrayUpdate
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update contenuto on db
     *
     * @param InputFilterAwareInterface $inputFilter
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();

        $arrayUpdate = array(
            'sottosezione_id'   => $inputFilter->sottosezione,
            'titolo'            => $inputFilter->titolo,
            'sommario'          => $inputFilter->sommario,
            'testo'             => $inputFilter->testo,
            'data_inserimento'  => $inputFilter->dataInserimento,
            'data_scadenza'     => $inputFilter->dataScadenza,
            'attivo'            => $inputFilter->attivo,
            'slug'              => Slugifier::slugify($inputFilter->titolo),
            'home'              => $inputFilter->home,
            'rss'               => $inputFilter->rss,
        );

        if (isset($inputFilter->utente)) {
            $arrayUpdate['utente_id'] = $inputFilter->utente;
        }

        return $this->getConnection()->update(
            DbTableContainer::contenuti,
            $arrayUpdate,
            array('id' => $inputFilter->id)
        );
    }

    /**
     * Update contenuti tabella field
     *
     * @param InputFilterAwareInterface $inputFilter
     *
     * @return int
     */
    public function updateTabella(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::contenuti,
            array('tabella' => $inputFilter->tabella),
            array('id' => $inputFilter->id)
        );
    }

    /**
     * Delete contenuto from db
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $this->assertConnection();

        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
        $this->getConnection()->delete(
            DbTableContainer::contenuti,
            array('id' => $id),
            array('limit' => 1)
        );
        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');

        return true;
    }
}
