<?php

namespace Admin\src\Admin\Model\Posts;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

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
        $this->id    		    = (isset($data['id']))              ? $data['id'] : null;
        $this->image    		= (isset($data['image']))           ? $data['image'] : null;
        $this->title 	 		= (isset($data['title']))           ? $data['title'] : null;
        $this->subtitle 	    = (isset($data['subtitle']))        ? $data['subtitle'] : null;
        $this->description  	= (isset($data['description']))     ? $data['description'] : null;
        $this->seoUrl           = (isset($data['seoUrl']))          ? $data['seoUrl']  : null;
        $this->expireDate  	    = (isset($data['expireDate']))      ? $data['expireDate'] : null;
        $this->seoKeywords  	= (isset($data['seoKeywords']))     ? $data['seoKeywords'] : null;
        $this->seoDescription  	= (isset($data['seoDescription']))  ? $data['seoDescription'] : null;
        $this->status  	        = (isset($data['status']))          ? $data['status'] : null;
        $this->categories       = (isset($data['categories']))      ? $data['categories'] : null;
        $this->csrf             = (isset($data['csrf']))            ? $data['csrf'] : null;
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
                'name' => 'Testo',
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