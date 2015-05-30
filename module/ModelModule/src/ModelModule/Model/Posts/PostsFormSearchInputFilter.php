<?php

namespace Admin\src\Admin\Model\Posts;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class PostsFormSearchInputFilter implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {

            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput([
                'name' => 'Testo',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                ),
            ]));

            $inputFilter->add($factory->createInput([
                    'name' => 'Blog',
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array (
                            'name' => 'InArray',
                            'options' => array(
                                'haystack' => array(0, 1),
                                'messages' => array(
                                    'notInArray' => 'undefined'
                                ),
                            ),
                        ),
                    ),
                ])
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}