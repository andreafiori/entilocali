<?php

namespace ModelModule\Model\Users\Settori;

use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Users\UsersControllerHelper;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * Users Settori Controller Helper
 */
class SettoriControllerHelper extends UsersControllerHelper
{
    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     */
    public function insert(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();
        $this->assertEntityManager();

        return $this->getEntityManager()->getConnection()->insert(
            DbTableContainer::usersSettori,
            array(
            'nome'                 => $inputFilter->nome,
            'stato'                => 1,
            'responsabile_user_id' => $inputFilter->responsabileUserId,
        ));
    }

    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     */
    public function update(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::usersSettori,
            array(
                'nome'                  => $inputFilter->nome,
                'responsabile_user_id'  => $inputFilter->responsabileUserId,
            ),
            array(
                'id' => $inputFilter->id
            )
        );
    }
}