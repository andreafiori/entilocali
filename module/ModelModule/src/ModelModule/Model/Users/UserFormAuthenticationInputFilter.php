<?php

namespace ModelModule\Model\Users;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class UserFormAuthenticationInputFilter implements InputFilterAwareInterface
{
    public $username;
    public $password;
    public $csrf;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->username = (isset($data['username']))   ? $data['username']    : null;
        $this->password = (isset($data['password']))   ? $data['password']    : null;
        $this->csrf     = (isset($data['csrf']))       ? $data['csrf']        : null;
    }

    /**
     * @param InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("This method is unused");
    }

    /**
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput([
                'name' => 'username',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Nome utente obbligatorio',
                            )
                        ),
                    ),
                ),
            ]));

            $inputFilter->add($factory->createInput(array(
                'name' => 'password',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(

                ),
            )));

            /*
            $inputFilter->add($factory->createInput(array(
                'name' => 'csrf',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            )));
            */

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}