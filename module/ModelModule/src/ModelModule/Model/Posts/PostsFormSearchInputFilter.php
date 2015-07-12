<?php

namespace Admin\src\Admin\Model\Posts;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 *  Posts Form Validator
 */
class PostsFormSearchInputFilter implements InputFilterAwareInterface
{
    public $testo;
    public $category;
    public $csrf;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $this->testo     = (isset($data['testo']))           ? $data['testo'] : null;
        $this->category  = (isset($data['category']))        ? $data['category'] : null;
        $this->csrf      = (isset($data['csrf']))            ? $data['csrf'] : null;
    }

    /**
     * Unused method
     *
     * @param InputFilterInterface $inputFilter
     *
     * @throws \Exception
     */
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
                'name' => 'testo',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(

                ),
            ]));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'category',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput([
                'name' => 'csrf',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(

                ),
            ]));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}