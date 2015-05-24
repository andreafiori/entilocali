<?php

namespace Admin\Model;

use Application\Model\NullException;
use Admin\Model\Users\UsersGetterWrapper;
use Application\Model\Database\DbTableContainer;

abstract class ControllerHelperAbstract extends OperationsModelAbstract
{
    /**
     * @var UsersGetterWrapper
     */
    protected $usersGetterWrapper;

    protected $usersGetterWrapperRecords;

    protected $homePageBlocksGetterWrapper;

    protected $homePageBlocksRecords;

    /**
     * @param UsersGetterWrapper $usersGetterWrapper
     */
    public function setUsersGetterWrapper(UsersGetterWrapper $usersGetterWrapper)
    {
        $this->usersGetterWrapper = $usersGetterWrapper;
    }

    /**
     * @return UsersGetterWrapper
     */
    public function getUsersGetterWrapper()
    {
        return $this->usersGetterWrapper;
    }

    /**
     * @return array
     */
    public function getUsersGetterWrapperRecords()
    {
        return $this->usersGetterWrapperRecords;
    }

    /**
     * @param array $input
     */
    public function setupUsersGetterWrapperRecords($input = array())
    {
        $this->assertUsersGetterWrapper();

        $this->usersGetterWrapperRecords = $this->recoverWrapperRecords($this->getUsersGetterWrapper(), $input);
    }

    /**
     * @throws NullException
     */
    protected function assertUsersGetterWrapper()
    {
        if (!$this->getUsersGetterWrapper()) {
            throw new NullException("UsersGetterWrapper is not set");
        }
    }

    /**
     * @return mixed
     */
    public function getHomePageBlocksGetterWrapper()
    {
        return $this->homePageBlocksGetterWrapper;
    }

    /**
     * @throws NullException
     */
    protected function assertHomePageBlocksGetterWrapper()
    {
        if (!$this->getHomePageBlocksGetterWrapper()) {
            throw new NullException("HomePageBlocksGetterWrapper is not set");
        }
    }

    /**
     * @param mixed $homePageBlocksGetterWrapper
     */
    public function setHomePageBlocksGetterWrapper($homePageBlocksGetterWrapper)
    {
        $this->homePageBlocksGetterWrapper = $homePageBlocksGetterWrapper;
    }

    /**
     * @param mixed $homePageBlocksRecords
     */
    public function setupHomePageBlocksRecords($input = array())
    {
        $this->assertHomePageBlocksGetterWrapper();

        $this->homePageBlocksRecords = $this->recoverWrapperRecords(
            $this->getHomePageBlocksGetterWrapper(),
            $input
        );
    }

    /**
     * @return mixed
     */
    public function getHomePageBlocksRecords()
    {
        return $this->homePageBlocksRecords;
    }

    /**
     * @throws NullException
     */
    public function checkHomePageBlocksRecords()
    {
        $homeBlockRecords = $this->getHomePageBlocksRecords();
        if ( empty($homeBlockRecords) ) {
            throw new NullException("HomePageBlocksRecords are not set");
        }
    }

    /**
     * Perform inset on homepage db table
     */
    public function insertInHomePage($id)
    {
        $this->assertConnection();

        $this->checkHomePageBlocksRecords();

        $blockRecords = $this->getHomePageBlocksRecords();

        $this->getConnection()->insert(
            DbTableContainer::homepage,
            array(
                'title'             => null,
                'description'       => null,
                'free_text'         => null,
                'show_attachments'  => 1,
                'highlight'         => 0,
                'position'          => 1,
                'language_id'       => isset($blockRecords[0]['languageId']) ? $blockRecords[0]['languageId'] : 1,
                'reference_id'      => $id,
                'block_id'          => $blockRecords[0]['id'],
            )
        );
    }
}