<?php

namespace ModelModule\Model;

use ModelModule\Model\Contacts\ContactsGetter;
use ModelModule\Model\Contacts\ContactsGetterWrapper;
use ModelModule\Model\Log\LogGetter;
use ModelModule\Model\Log\LogGetterWrapper;
use ModelModule\Model\Tickets\TicketsGetter;
use ModelModule\Model\Tickets\TicketsGetterWrapper;
use ModelModule\Model\Users\Todo\UsersTodoForm;
use ModelModule\Model\Users\Todo\UsersTodoGetter;
use ModelModule\Model\Users\Todo\UsersTodoGetterWrapper;
use ModelModule\Model\RouterManagers\RouterManagerAbstract;
use ModelModule\Model\RouterManagers\RouterManagerInterface;

class AdminDashboard extends RouterManagerAbstract implements RouterManagerInterface
{
    /**
     * @return mixed
     */
    public function setupRecord()
    {
        $userDetails = $this->getInput('userDetails', 1);

        $logRecords = $this->recoverLogRecords($userDetails->id);

        $todoForm = new UsersTodoForm();

        $todoList = $this->recoverTodoRecords();
        $todoListCount = count($todoList);

        $wrapper = new TicketsGetterWrapper(new TicketsGetter($this->getInput('entityManager', 1)));
        $wrapper->setInput(array(
            'userId'    => $userDetails->id,
            'orderBy'   => 't.createDate DESC',
            'limit'     => 15,
        ));
        $wrapper->setupQueryBuilder();

        $ticketList = $wrapper->getRecords();

        $date1 = date_create( $userDetails->passwordLastUpdate->format("Y-m-d H:i:s") );
        $date2 = date_create( date("Y-m-d H:i:s") );

        $interval = $date2->diff($date1);

        $this->setVariables(array(
                'contactFormMsg'                => $this->recoverContactsMessages(),
                'todoForm'                      => $todoForm,
                'todoList'                      => $todoList,
                'todoListCount'                 => $todoListCount,
                'ticketList'                    => $ticketList,
                'ticketCount'                   => count($ticketList),
                'logRecords'                    => $logRecords,
                'formDataCommonPath'            => 'backend/templates/common/',
                'showPasswordNotSecureWarning'  => (empty($this->userDetails->salt)) ?  false : true,
                'showUpdatePasswordWarning'     => ($interval->format('%m months') > 6) ? true : false,
            )
        );

        return $this->getOutput();
    }

        /**
         * @param int $userId
         *
         * @return \ModelModule\Model\QueryBuilderHelperAbstract
         */
        private function recoverLogRecords($userId)
        {
            $logWrapper = new LogGetterWrapper(new LogGetter($this->getInput('entityManager', 1)));
            $logWrapper->setInput(array(
                'userId'    => $userId,
                'orderBy'   => 'l.datetime DESC',
                'limit'     => 15,
            ));
            $logWrapper->setupQueryBuilder();

            return $logWrapper->getRecords();
        }

        /**
         * @return \ModelModule\Model\QueryBuilderHelperAbstract
         * @throws \ModelModule\Model\NullException
         */
        private function recoverTodoRecords()
        {
            $todoWrapper = new UsersTodoGetterWrapper(new UsersTodoGetter($this->getInput('entityManager', 1)));
            $todoWrapper->setInput(array());
            $todoWrapper->setupQueryBuilder();

            return $todoWrapper->getRecords();
        }

        /**
         * @return QueryBuilderHelperAbstract
         * @throws NullException
         */
        private function recoverContactsMessages()
        {
            $wrapper = new ContactsGetterWrapper(new ContactsGetter($this->getInput('entityManager', 1)));
            $wrapper->setInput(array('fields' => 'COUNT(c.id) AS msgCount '));
            $wrapper->setupQueryBuilder();

            return  $wrapper->getRecords();
        }
}
