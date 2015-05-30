<?php

namespace ModelModule\Model\AttiConcessione;

use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use ModelModule\Model\NullException;

class AttiConcessioneControllerHelper
{
    private $attiConcessioneGetterWrapper;

    private $attiConcessioneGetterWrapperWithPaginator;

    private $yearsRecords;

    private $usersSettoriGetterWrapper;

    private $usersSettoriRecords;

    /**
     * @param AttiConcessioneGetterWrapper $wrapper
     */
    public function setAttiConcessioneGetterWrapper(AttiConcessioneGetterWrapper $wrapper)
    {
        $this->attiConcessioneGetterWrapper = $wrapper;
    }

    /**
     * @throws NullException
     */
    private function assertAttiConcessioneGetterWrapper()
    {
        if (!$this->getAttiConcessioneGetterWrapper()) {
            throw new NullException("AttiConcessioneGetterWrapper is not set");
        }
    }

    /**
     * @param array $input
     * @param int $page
     * @param int $perPage
     */
    public function setupAttiConcessioneGetterWrapperWithPaginator($input = array(), $page, $perPage)
    {
        $this->assertAttiConcessioneGetterWrapper();

        $wrapper = $this->getAttiConcessioneGetterWrapper();
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($wrapper->getObjectGetter()->getEntityManager()) );
        $wrapper->setEntityManager($wrapper->getObjectGetter()->getEntityManager());
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage($perPage);

        $this->attiConcessioneGetterWrapperWithPaginator = $wrapper;
    }

    /**
     * @return AttiConcessioneGetterWrapper
     */
    public function getAttiConcessioneGetterWrapperWithPaginator()
    {
        return $this->attiConcessioneGetterWrapperWithPaginator;
    }

    public function setupYearsRecords()
    {
        $this->assertAttiConcessioneGetterWrapper();

        $wrapper = $this->getAttiConcessioneGetterWrapper();
        $wrapper->setInput(array('fields' => 'DISTINCT(atti.anno) AS year', 'orderBy' => 'atti.id DESC'));
        $wrapper->setupQueryBuilder();

        $this->yearsRecords = $wrapper->getRecords();
    }

    /**
     * @return UsersSettoriGetterWrapper
     */
    public function getUsersSettoriGetterWrapper()
    {
        return $this->usersSettoriGetterWrapper;
    }

    /**
     * @return mixed
     */
    public function getYearsRecords()
    {
        return $this->yearsRecords;
    }

    /**
     * @return AttiConcessioneGetterWrapper
     */
    public function getAttiConcessioneGetterWrapper()
    {
        return $this->attiConcessioneGetterWrapper;
    }

    /**
     * @param array $years
     * @return array
     */
    public function formatYears($years)
    {
        if (!empty($years)) {
            $yearsForDropdown = array();
            foreach($years as $year) {
                if (isset($year['year'])) {
                    $yearsForDropdown[$year['year']] = $year['year'];
                }
            }

            return $yearsForDropdown;
        }

        return false;
    }

    /**
     * @param UsersSettoriGetterWrapper $wrapper
     */
    public function setUsersSettoriGetterWrapper(UsersSettoriGetterWrapper $wrapper)
    {
        $this->usersSettoriGetterWrapper = $wrapper;
    }

    public function setupSettoriRecords($input)
    {
        $this->assertUsersSettoriGetterWrapper();

        $this->usersSettoriGetterWrapper->setInput($input);
        $this->usersSettoriGetterWrapper->setupQueryBuilder();

        $this->usersSettoriRecords = $this->usersSettoriGetterWrapper->formatForDropwdown(
            $this->usersSettoriGetterWrapper->getRecords(),
            'id',
            'nome'
        );
    }

    /**
     * @return array
     */
    public function getUsersSettoriRecords()
    {
        return $this->usersSettoriRecords;
    }

    /**
     * @throws NullException
     */
    private function assertUsersSettoriGetterWrapper()
    {
        if ( !$this->getUsersSettoriGetterWrapper() ) {
            throw new NullException("UsersSettoriGetterWrapper is not set");
        }
    }
}