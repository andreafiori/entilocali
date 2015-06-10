<?php

namespace ModelModule\Model\Users;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class UsersFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $username;
    public $password;
    public $password_verify;
    public $roleId;
    public $settoreId;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id                   = (isset($data['id']))      ? $data['id'] : null;
        $this->name                 = (isset($data['name']))    ? $data['name'] : null;
        $this->surname              = (isset($data['surname'])) ? $data['surname'] : null;
        $this->email                = (isset($data['email'])) ? $data['email'] : null;
        $this->username             = (isset($data['username'])) ? $data['username'] : null;
        $this->password             = (isset($data['password'])) ? $data['password'] : null;
        $this->password_verify      = (isset($data['password_verify'])) ? $data['password_verify'] : null;
        $this->roleId               = (isset($data['roleId'])) ? $data['roleId'] : null;
        $this->settoreId            = (isset($data['settoreId'])) ? $data['settoreId'] : null;
    }

    /**
     * @param InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * @return mixed
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 160,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'surname',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 160,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 160,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'username',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 160,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'password',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                ),
            ));

            $inputFilter->add(array(
                'name' => 'password_verify',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'identical',
                        'options' => array(
                            'token' => 'password',
                        ),
                    ),

                ),
            ));

            $inputFilter->add(array(
                'name'     => 'roleId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'settoreId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'roleId',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}

