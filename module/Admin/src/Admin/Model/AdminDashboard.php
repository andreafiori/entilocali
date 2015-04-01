<?php

namespace Admin\Model;

use Admin\Model\Contacts\ContactsGetter;
use Admin\Model\Contacts\ContactsGetterWrapper;
use Admin\Model\Logs\LogsGetter;
use Admin\Model\Logs\LogsGetterWrapper;
use Admin\Model\Tickets\TicketsGetter;
use Admin\Model\Tickets\TicketsGetterWrapper;
use Admin\Model\Users\Todo\UsersTodoForm;
use Admin\Model\Users\Todo\UsersTodoGetter;
use Admin\Model\Users\Todo\UsersTodoGetterWrapper;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
        
/**
 * Backend Frontend home page handler
 *
 * TODO: get TODO list, render TODO form, select count of all modules...
 *
 * @author Andrea Fiori
 * @since  18 May 2014
 */
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
        $wrapper->setInput(array());
        $wrapper->setupQueryBuilder();

        $ticketList = $wrapper->getRecords();

        $this->setVariables(array(
                'contactFormMsg'     => $this->recoverContactsMessages(),
                'todoForm'           => $todoForm,
                'todoList'           => $todoList,
                'todoListCount'      => $todoListCount,
                'ticketList'         => $ticketList,
                'ticketCount'        => count($ticketList),
                'logRecords'         => $logRecords,
                'formDataCommonPath' => 'backend/templates/common/'
            )
        );

        return $this->getOutput();
    }

        /**
         * @param int $userId
         *
         * @return \Application\Model\QueryBuilderHelperAbstract
         */
        private function recoverLogRecords($userId)
        {
            $logWrapper = new LogsGetterWrapper(new LogsGetter($this->getInput('entityManager', 1)));
            $logWrapper->setInput(array(
                'userId'    => $userId,
                'orderBy'   => 'l.datetime DESC',
                'limit'     => 15,
            ));
            $logWrapper->setupQueryBuilder();

            return $logWrapper->getRecords();
        }

        /**
         * @return \Application\Model\QueryBuilderHelperAbstract
         * @throws \Application\Model\NullException
         */
        private function recoverTodoRecords()
        {
            $todoWrapper = new UsersTodoGetterWrapper(new UsersTodoGetter($this->getInput('entityManager', 1)));
            $todoWrapper->setInput(array());
            $todoWrapper->setupQueryBuilder();

            return $todoWrapper->getRecords();
        }

        private function recoverContactsMessages()
        {
            $wrapper = new ContactsGetterWrapper(new ContactsGetter($this->getInput('entityManager', 1)));
            $wrapper->setInput(array('fields' => 'COUNT(c.id) AS msgCount '));
            $wrapper->setupQueryBuilder();

            return  $wrapper->getRecords();
        }
}
