<?php

namespace ModelModule\Model\Users;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container as SessionContainer;

/**
 * User Controller Helper
 */
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
     *
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
     * Insert a new user encoding the password
     *
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $encodedPassword = $this->encodePassword($formData->password);

        $today = date("Y-m-d H:i:s");

        $arrayInsert = array(
            'name'                  => $formData->name,
            'surname'               => $formData->surname,
            'email'                 => $formData->email,
            'username'              => $formData->username,
            'password'              => $encodedPassword['password'],
            'salt'                  => $encodedPassword['salt'],
            'password_last_update'  => $today,
            'role_id'               => $formData->roleId,
            'settore_id'            => !empty($formData->settoreId) ? $formData->settoreId : null,
            'last_update'           => $today,
            'create_date'           => $today,
        );

        $this->getConnection()->insert(
            DbTableContainer::users,
            $arrayInsert
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update user
     *
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
            'settore_id'    => !empty($formData->settoreId) ? $formData->settoreId : null,
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

        return $this->getConnection()->update(
            DbTableContainer::users,
            $arrayToUpdate,
            array('id' => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * Update confirm code
     *
     * @param int $userId
     * @param string $confirmCode
     * @return int
     */
    public function updateConfirmCode($userId, $confirmCode)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::users,
            array(
                'confirm_code' => $confirmCode
            ),
            array('id' => $userId),
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

    /**
     * TODO: delete user, delete roles, delete or annull association (maybe assign all to the first webmaster)....
     */
    public function delete()
    {

    }

    /**
     * Format Users for a dropdown form control
     *
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

    /**
     * @param array $records
     * @return array
     */
    public function gatherIdsFromRecordset($records, $idField = 'userId')
    {
        $container = array();
        foreach($records as $record) {
            if (isset($record[$idField])) {
                $container[] = $record[$idField];
            }
        }

        return $container;
    }
}