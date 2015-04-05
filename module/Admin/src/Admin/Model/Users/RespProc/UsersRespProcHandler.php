<?php

namespace Admin\Model\Users\RespProc;

use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Application\Model\Database\DbTableContainer;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use ZfTable\Controller\TableController;

/**
 * @author Andrea Fiori
 * @since  25 March 2015
 */
class UsersRespProcHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param',1);

        if (!empty($param['post']['user'])) {
            $connection = $this->getInput('entityManager',1)->getConnection();
            $connection->insert(
                DbTableContainer::usersRespProc,
                array(
                    'user_id' => $param['post']['user'],
                    'attivo'  => 1,
                )
            );
        }

        if (!empty($param['post']['deleteId'])) {
            $connection = $this->getInput('entityManager',1)->getConnection();
            $connection->beginTransaction();
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $connection->delete(
                DbTableContainer::usersRespProc,
                array('id' => $param['post']['deleteId']),
                array('limit'=>1)
            );
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
            $connection->commit();
        }


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
