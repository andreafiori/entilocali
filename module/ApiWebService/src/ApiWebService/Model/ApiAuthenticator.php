<?php

namespace ApiWebService\Model;

use Zend\Http\Response;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  23 August 2014
 */
class ApiAuthenticator extends ApiInputSetterGetter
{
    private $usersGetterWrapper;
    
    protected $entityManager;
    
    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @param \Admin\Model\Users\UsersGetterWrapper $usersGetterWrapper
     * @return type
     */
    public function setUsersGetterWrapper(UsersGetterWrapper $usersGetterWrapper)
    {
        $this->usersGetterWrapper = $usersGetterWrapper;
        
        return $this->usersGetterWrapper;
    }
    
    /**
     * @return \Admin\Model\Users\UsersGetterWrapper
     */
    public function getUsersGetterWrapper()
    {
        return $this->usersGetterWrapper;
    }
    
    /**
     * 
     * @param array $authenticationInput
     * @return type
     * @throws NullException
     */
    public function authenticate(array $authenticationInput)
    {
        $this->usersGetterWrapper->setInput($authenticationInput);
        $this->usersGetterWrapper->setupQueryBuilder();
        $this->usersGetterWrapper->setupPaginator( $this->usersGetterWrapper->setupQuery($this->getEntityManager()) );
        $this->usersGetterWrapper->setupPaginatorCurrentPage();
        $this->usersGetterWrapper->setupPaginatorItemsPerPage();

        $paginator = $this->usersGetterWrapper->getPaginator();
        $arrayToReturn = array();
        foreach($paginator as $row) {
            $arrayToReturn[] = $row;
        }

        if ( count($arrayToReturn) != 1 ) {
            $this->setupResponseToReturn(Response::STATUS_CODE_403, 'Unauthiorized: bad authentication.');

            throw new NullException('Unauthiorized: bad authentication.');
        }
        
        return $arrayToReturn;
    }
    
        /**
         * @throws NullException
         */
        private function checkUsersGetterWrapper()
        {
            if (!$this->usersGetterWrapper) {
                $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Error during the request: cannot get user informations.');
                
                throw new NullException('Error during the request: cannot get user informations.');
            }
        }
}

