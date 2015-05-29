<?php

namespace Admin\Model\Sezioni;

use Application\Model\Database\DbTableContainer;
use Application\Model\Slugifier;
use Zend\InputFilter\InputFilterAwareInterface;

class SezioniControllerHelper extends SezioniControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     * @throws NullException
     */
    public function update(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::sezioni,
            array(
                'nome'        => $inputFilter->nome,
                'colonna'     => $inputFilter->colonna,
                'lingua'      => $inputFilter->lingua,
                'attivo'      => $inputFilter->attivo,
                'url'         => $inputFilter->url,
                'slug'        => Slugifier::slugify($inputFilter->nome),
            ),
            array('id' => $inputFilter->id)
        );
    }
}