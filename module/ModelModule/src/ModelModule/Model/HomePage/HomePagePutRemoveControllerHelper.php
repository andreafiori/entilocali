<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;

/**
 * HomePage Put and Remove elements Helper
 */
class HomePagePutRemoveControllerHelper extends ControllerHelperAbstract
{
    /**
     * Insert element in homepage
     *
     * @param int $id
     * @param int $blockId
     * @param int $languageId
     *
     * @return string
     */
    public function insertInHomePage($id, $blockId, $languageId = 1)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::homepage,
            array(
                'title'             => null,
                'description'       => null,
                'free_text'         => null,
                'show_attachments'  => 1,
                'highlight'         => 0,
                'position'          => 1,
                'language_id'       => $languageId,
                'reference_id'      => $id,
                'block_id'          => $blockId,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Delete element from home page using referenceID and home page block ID
     *
     * @param int $referenceId
     * @param int $blockId
     *
     * @return int
     */
    public function deleteFromHomePage($referenceId, $blockId)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::homepage,
            array(
                'reference_id'  => $referenceId,
                'block_id'      => $blockId,
            ),
            array('limit' => 1)
        );
    }

    /**
     * Update an homepage flag on db
     *
     * @param int $id
     * @param int $home
     *
     * @return int
     */
    public function updateHomeFlag($dbTable, $id, $homeFlagFieldName = 'home', $homeFlagValue = 1)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            $dbTable,
            array($homeFlagFieldName => $homeFlagValue),
            array('id' => $id)
        );
    }

    /**
     * Recover homepage flag field name from module code
     *
     * @param string $moduleCode
     *
     * @return bool|string
     */
    public function recoverHomeFlagFromModuleCode($moduleCode)
    {
        if ($moduleCode == 'atti-concessione' or $moduleCode == 'contratti-pubblici') {
            return 'homepage';
        }

        if ($moduleCode == 'contenuti' or $moduleCode == 'amministrazione-trasparente' or $moduleCode == 'albo-pretorio') {
            return 'home';
        }

        if ($moduleCode == 'stato-civile') {
            return 'homepage_flag';
        }

        return false;
    }
}
