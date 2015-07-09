<?php

namespace ModelModule\Model\Contenuti;

use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Slugifier;

class ContenutiControllerHelper extends ContenutiControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $inputFilter
     * @param string $moduleName
     * @return int
     * @throws NullException
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

        return $this->getConnection()->insert(
            DbTableContainer::contenuti,
            $arrayUpdate
        );
    }

    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     * @throws NullException
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
     * @param InputFilterAwareInterface $inputFilter
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
}
