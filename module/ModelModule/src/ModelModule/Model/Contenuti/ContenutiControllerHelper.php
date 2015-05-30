<?php

namespace ModelModule\Model\Contenuti;

use ModelModule\Model\Sezioni\SezioniControllerHelperAbstract;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Slugifier;

class ContenutiControllerHelper extends SezioniControllerHelperAbstract
{
    private $contenutiGetterWrapper;

    private $contenutiGetterWrapperRecords;

    /**
     * @param ContenutiGetterWrapper $contenutiGetterWrapper
     */
    public function setContenutiGetterWrapper(ContenutiGetterWrapper $contenutiGetterWrapper)
    {
        $this->contenutiGetterWrapper = $contenutiGetterWrapper;
    }

    /**
     * @return ContenutiGetterWrapper
     */
    public function getContenutiGetterWrapper()
    {
        return $this->contenutiGetterWrapper;
    }

    /**
     * @param ContenutiGetterWrapper $contenutiGetterWrapperRecords
     */
    public function setContenutiGetterWrapperRecords(ContenutiGetterWrapper $contenutiGetterWrapperRecords)
    {
        $this->contenutiGetterWrapperRecords = $contenutiGetterWrapperRecords;
    }

    /**
     * @return mixed
     */
    public function getContenutiGetterWrapperRecords()
    {
        return $this->contenutiGetterWrapperRecords;
    }

    /**
     * @param array $input
     * @throws NullException
     */
    public function setupContenutiGetterWrapperRecords($input = array())
    {
        $this->assertContenutiGetterWrapper();

        $this->contenutiGetterWrapperRecords = $this->recoverWrapperRecords(
            $this->getContenutiGetterWrapper(),
            $input
        );
    }

    /**
     * @param array $input
     * @param int $page
     * @throws NullException
     */
    public function setupContenutiGetterWrapperRecordsPaginator($input = array(), $page)
    {
        $this->assertContenutiGetterWrapper();

        $this->contenutiGetterWrapperRecords = $this->recoverWrapperRecordsPaginator(
            $this->getContenutiGetterWrapper(),
            $input,
            $page
        );
    }

    /**
     * @throws NullException
     */
    private function assertContenutiGetterWrapper()
    {
        if (!$this->getContenutiGetterWrapper()) {
            throw new NullException("ContenutiGetterWrapper is not set");
        }
    }

    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     * @throws NullException
     */
    public function insert(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();
        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        $arrayUpdate = array(
            'sottosezione_id'   => $inputFilter->sottosezione,
            'titolo'            => $inputFilter->titolo,
            'sommario'          => strip_tags($inputFilter->sommario),
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
            'sommario'          => strip_tags($inputFilter->sommario),
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
}
