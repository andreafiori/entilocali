<?php

namespace ModelModule\Model\Posts;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\File\Size;

class PostsCategoriesFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $name;
    public $description;
    public $moduleId;
    public $languageId;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id               = (isset($data['id']))               ? $data['id']               : null;
        $this->name             = (isset($data['name']))             ? $data['name']             : null;
        $this->description      = (isset($data['description']))      ? $data['description']      : null;
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

            $inputFilter->add(array(
                'name' => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add($factory->createInput([
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
            ]));

            $inputFilter->add($factory->createInput([
                'name' => 'description',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(

                ),
            ]));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}