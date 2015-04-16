<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\OperationsHelperAbstract;
use Application\Model\Database\DbTableContainer;

/**
 * @author Andrea Fiori
 * @since  14 April 2015
 */
class AlboPretorioOperationsControllerHelper extends OperationsHelperAbstract
{
    private $articleRecord;

    /**
     * @param AlboPretorioArticoliGetterWrapper $wrapper
     * @param  int $id
     * @return \Application\Model\QueryBuilderHelperAbstract
     * @throws \Application\Model\NullException
     */
    public function recoverSingleArticle(AlboPretorioArticoliGetterWrapper $wrapper, $id)
    {
        $wrapper->setInput( array(
                'id'    => $id,
                'limit' => 1,
            )
        );

        $wrapper->setupQueryBuilder();

        $this->articleRecord = $wrapper->getRecords();

        return $this->articleRecord;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function publishArticle($id)
    {
        $this->assertConnection();

        $this->getConnection()->beginTransaction();
        $this->getConnection()->update(
            DbTableContainer::alboArticoli,
            array(
                'pubblicare' => 1,
                'attivo'     => 1,
                'annullato'  => 0,
            ),
            array('id' => $id)
        );
        $this->getConnection()->commit();

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function annullArticle($id)
    {
        $this->assertConnection();

        $this->getConnection()->beginTransaction();
        $this->getConnection()->update(
            DbTableContainer::alboArticoli,
            array(
                'pubblicare' => 0,
                'attivo'     => 0,
                'annullato'  => 1,
            ),
            array('id' => $id)
        );
        $this->getConnection()->commit();

        return true;
    }
}