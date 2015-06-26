<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;

class HomePageControllerHelper extends ControllerHelperAbstract
{
    /**
     * Insert in home page using the 3 main data
     *
     * @param int $languageId
     * @param int $referenceId
     * @param int $blockId
     */
    public function insertIntoHome($languageId, $referenceId, $blockId)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::homepage,
            array(
                'language_id'   => $languageId,
                'reference_id'  => $referenceId,
                'block_id'      => $blockId,
            )
        );
    }

    /**
     * @param $homePageId
     */
    public function deleteFromHomeById($homePageId)
    {
        $this->assertConnection();


    }
}