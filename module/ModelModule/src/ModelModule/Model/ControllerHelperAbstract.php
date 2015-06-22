<?php

namespace ModelModule\Model;

use ModelModule\Model\Languages\LanguagesFormSearch;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Users\UsersGetterWrapper;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModule\Model\Database\DbTableContainer;

abstract class ControllerHelperAbstract extends OperationsModelAbstract
{
    /**
     * @var UsersGetterWrapper
     */
    protected $usersGetterWrapper;

    protected $usersGetterWrapperRecords;

    /**
     * @var HomePageBlocksGetterWrapper
     */
    protected $homePageBlocksGetterWrapper;

    protected $homePageBlocksRecords;

    /**
     * @var LanguagesGetterWrapper
     */
    protected $languagesGetterWrapper;

    protected $languagesGetterWrapperRecords;

    protected $loggedUser;

    /**
     * @param mixed $loggedUser
     */
    public function setLoggedUser($loggedUser)
    {
        $this->loggedUser = $loggedUser;
    }

    /**
     * @throws NullException
     */
    protected function assertLoggedUser()
    {
        if (!$this->getLoggedUser()) {
            throw new NullException("Logged user data are not set");
        }
    }

    /**
     * @return mixed
     */
    public function getLoggedUser()
    {
        return $this->loggedUser;
    }

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
     * @param HomePageBlocksGetterWrapper $homePageBlocksGetterWrapper
     */
    public function setHomePageBlocksGetterWrapper(HomePageBlocksGetterWrapper $homePageBlocksGetterWrapper)
    {
        $this->homePageBlocksGetterWrapper = $homePageBlocksGetterWrapper;
    }

    /**
     * @return HomePageBlocksGetterWrapper
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
     * Inset on homepage db table using referenceID only
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

    /**
     * @param mixed $languagesGetterWrapper
     */
    public function setLanguagesGetterWrapper(LanguagesGetterWrapper $languagesGetterWrapper)
    {
        $this->languagesGetterWrapper = $languagesGetterWrapper;
    }

    /**
     * @return LanguagesGetterWrapper
     */
    public function getLanguagesGetterWrapper()
    {
        return $this->languagesGetterWrapper;
    }

    /**
     * @throws NullException
     */
    protected function assertLanguagesGetterWrapper()
    {
        if (!$this->getLanguagesGetterWrapper()) {
            throw new NullException("LanguagesGetterWrapper is not set");
        }
    }

    public function setupLanguagesGetterWrapperRecords($input = array())
    {
        $this->assertLanguagesGetterWrapper();

        $this->languagesGetterWrapperRecords = $this->recoverWrapperRecords(
            $this->getLanguagesGetterWrapper(),
            $input
        );
    }

    /**
     * @return mixed
     */
    public function getLanguagesGetterWrapperRecords()
    {
        return $this->languagesGetterWrapperRecords;
    }

    /**
     * @param LanguagesFormSearch $formLanguage
     * @param array $input
     * @param string $languageSelection
     * @return LanguagesFormSearch
     */
    public function setupLanguageFormSearch(LanguagesFormSearch $formLanguage, array $wrapperInput, $languageSelection)
    {
        $this->assertLanguagesGetterWrapper();

        $wrapper = $this->recoverWrapper($this->getLanguagesGetterWrapper(), $wrapperInput);

        $formLanguage->addLanguages(
            $wrapper->formatForDropwdown(
                $wrapper->getRecords(),
                'abbreviation1',
                'name'
            )
        );
        $formLanguage->addSubmitButton();
        $formLanguage->setData( array('lingua' => $languageSelection) );

        return $formLanguage;
    }

    /**
     * Ensure the given recordset is not empty
     *
     * @param $recordset
     * @param string $message
     * @throws NullException
     */
    public function checkRecordset($recordset, $message = 'Empty recordset')
    {
        if ( empty($recordset) ) {
            throw new NullException($message);
        }
    }
}