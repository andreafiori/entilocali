<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\ControllerHelperAbstract;

class AlboPretorioSezioniControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param AlboPretorioSezioniFormInputFilter $formData
     * @return int
     */
    public function insert(AlboPretorioSezioniFormInputFilter $formData)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::alboSezioni,
            array(
                'nome'   => $formData->nome,
                'attivo' => $formData->attivo,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * @param AlboPretorioSezioniFormInputFilter $formData
     * @return int
     */
    public function update(AlboPretorioSezioniFormInputFilter $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::alboSezioni,
            array(
                'nome'   => $formData->nome,
                'attivo' => $formData->attivo,
            ),
            array(
                'id' => $formData->id
            )
        );
    }

    public function delete($id)
    {
        // TODO: delete sezione, delete albo articoli (ONLY WEBMASTERS!)
    }
}