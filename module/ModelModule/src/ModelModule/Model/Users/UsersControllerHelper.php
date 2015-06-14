<?php

namespace ModelModule\Model\Users;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container as SessionContainer;

class UsersControllerHelper extends ControllerHelperAbstract
{
    /**
     * Verify if two passwords are different
     *
     * @param string $password
     * @param string $passwordVerify
     * @param string $message
     */
    public function verifyPassword($password, $passwordVerify, $message)
    {
        if ($password != $passwordVerify) {
            throw new NullException($message);
        }
    }

    /**
     * Generate a salt string to concatenate and decode with a password
     *
     * @return string
     */
    public function generateSalt()
    {
        return uniqid();
    }

    /**
     * Encode password joining salt and password
     *
     * @param string $password
     * @return array
     */
    public function encodePassword($password)
    {
        $salt = $this->generateSalt();

        return array(
            'password' => md5($password.$salt),
            'salt'     => $salt,
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $encodedPassword = $this->encodePassword($formData->password);

        $arrayInsert = array(
            'name'          => $formData->name,
            'surname'       => $formData->surname,
            'email'         => $formData->email,
            'username'      => $formData->username,
            'password'      => $encodedPassword['password'],
            'salt'          => $encodedPassword['salt'],
            'role_id'       => $formData->roleId,
            'settore_id'    => $formData->settoreId,
            'last_update'   => date("Y-m-d H:i:s"),
            'create_date'   => date("Y-m-d H:i:s"),
        );

        return $this->getConnection()->insert(
            DbTableContainer::users,
            $arrayInsert
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $arrayToUpdate = array(
            'name'          => $formData->name,
            'surname'       => $formData->surname,
            'email'         => $formData->email,
            'username'      => $formData->username,
            'last_update'   => date("Y-m-d H:i:s"),
        );

        if (!empty($formData->password)) {
            $encodedPassword = $this->encodePassword($formData->password);

            $arrayToUpdate['password'] = $encodedPassword['password'];
            $arrayToUpdate['salt'] = $encodedPassword['salt'];
            $arrayToUpdate['password_last_update'] = date("Y-m-d H:i:s");
        }

        if (!empty($formData->roleId)) {
            $arrayToUpdate['role_id'] = $formData->roleId;
        }

        if (!empty($formData->settore_id)) {
            $arrayToUpdate['settore_id'] = $formData->settore_id;
        }

        return $this->getConnection()->update(
            DbTableContainer::users,
            $arrayToUpdate,
            array('id' => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * TODO: Update last update date password session
     */
    public function updateLastUpdatePassword()
    {
        $sessionContainer = new SessionContainer();

        $userDetails = $sessionContainer->offsetExists('userDetails');

        return $userDetails;
    }

    public function delete()
    {
        // TODO: delete user, delete roles, delete every association....
    }

    /**
     * @param $recordset
     * @param $idFieldName
     * @return array|bool
     */
    public function formatUsersForDropdown($recordset, $idFieldName)
    {
        if (!empty($recordset)) {
            $arrayToReturn = array();
            foreach($recordset as $record) {
                if (!isset($record[$idFieldName])) {
                    break;
                }
                $arrayToReturn[$record[$idFieldName]] = $record['surname'].' '.$record['name'];
            }
            return $arrayToReturn;
        }

        return false;
    }
}
