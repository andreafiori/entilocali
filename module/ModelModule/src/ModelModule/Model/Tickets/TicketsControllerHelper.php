<?php

namespace ModelModule\Model\Tickets;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class TicketsControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     * @throws \ModelModule\Model\NullException
     */
    public function insertTicket(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();

        $userDetails = $this->getLoggedUser();

        return $this->getConnection()->insert(
            DbTableContainer::tickets,
            array(
                'title'         => $inputFilter->subject,
                'subject'       => $inputFilter->subject,
                'priority'      => $inputFilter->priority,
                'create_date'   => date("Y-m-d H:i:s"),
                'status'        => null,
                'created_by_id' => $userDetails->id,
            )
        );
    }

    /**
     * @param InputFilterAwareInterface $inputFilter
     * @param int $ticketId
     * @return int
     */
    public function insertTicketMessage(InputFilterAwareInterface $inputFilter, $ticketId)
    {
        $this->assertConnection();

        $userDetails = $this->getLoggedUser();

        return $this->getConnection()->insert(
            DbTableContainer::ticketsMessages,
            array(
                'message'       => $inputFilter->message,
                'insert_date'   => date("Y-m-d H:i:s"),
                'ticket_id'     => $ticketId,
                'user_id'       => $userDetails->id,
            )
        );
    }
}