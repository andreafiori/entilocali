<?php

namespace Admin\Model\Users\RespProc;

use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  25 March 2015
 */
class UsersRespProcHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $form = new UsersRespProcForm();
        $form->addUsers($this->recoverUsersRecords(array(
                'fields'      => 'u.id, u.name, u.surname',
                'adminAccess' => 1,
                'orderBy'     => 'u.surname'
            )
        ));

        $usersRespProc = $this->recoverUsersRespProc(array());

        $this->setVariables(array(
                'form'                  => $form,
                'usersRespProc'         => $usersRespProc,
                'formDataCommonPath'    => 'backend/templates/common/',
            )
        );

        $this->setTemplate('users/resp-proc-management.phtml');
    }

        /**
         * @param array $input
         *
         * @return array
         */
        private function recoverUsersRecords($input = array())
        {
            $wrapper = new UsersGetterWrapper(new UsersGetter($this->getInput('entityManager',1)));
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();

            $toReturn = array();
            foreach($records as $record) {
                $toReturn[$record['id']] = $record['surname'].' '.$record['name'];
            }

            return $toReturn;
        }

        /**
         * @param array $input
         *
         * @return array
         */
        private function recoverUsersRespProc($input = array())
        {
            $wrapper = new UsersRespProcGetterWrapper(new UsersRespProcGetter($this->getInput('entityManager',1)));
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
}
