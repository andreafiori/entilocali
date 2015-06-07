<?php

namespace ModelModule\Model\Sezioni;

use ModelModule\Model\Contenuti\ContenutiControllerHelperAbstract;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Slugifier;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\NullException;

class SottosezioniControllerHelper extends ContenutiControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     * @throws NullException
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        return $this->getConnection()->insert(
            DbTableContainer::sottosezioni,
            array(
                'nome'              => $formData->nomeSottoSezione,
                'sezione_id'        => $formData->sezione,
                'url'               => $formData->url,
                'url_title'         => $formData->urlTitle,
                'posizione'         => $formData->posizione,
                'attivo'            => $formData->attivo,
                'profondita_da'     => 0,
                'profondita_a'      => '',
                'slug'              => Slugifier::slugify($formData->nomeSottoSezione),
                'utente_id'         => $userDetails->id,
            )
        );
    }
    
    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     * @throws NullException
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        return $this->getConnection()->update(
            DbTableContainer::sottosezioni,
            array(
                'nome'          => $formData->nomeSottoSezione,
                'attivo'        => $formData->attivo,
                'sezione_id'    => $formData->sezione,
                'url'           => $formData->url,
                'url_title'     => $formData->urlTitle,
            ),
            array(
                'id' => $formData->idSottoSezione
            )
        );
    }
}