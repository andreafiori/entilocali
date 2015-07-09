<?php

namespace ModelModule\Model;

use ModelModule\Model\Languages\LanguagesFormSearch;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Users\UsersGetterWrapper;

/**
 * Controller Helper Abstraction
 */
abstract class ControllerHelperAbstract extends OperationsModelAbstract
{
    /**
     * @var UsersGetterWrapper
     */
    protected $usersGetterWrapper;

    protected $usersGetterWrapperRecords;

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

    /**
     * @param array $input
     */
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
     *
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
     *
     * @throws NullException
     */
    public function checkRecordset($recordset, $message = 'Empty recordset')
    {
        if ( empty($recordset) ) {
            throw new NullException($message);
        }
    }
}
