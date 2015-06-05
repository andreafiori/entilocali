<?php

namespace ModelModule\Model\Posts;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class PostsFormInputFilter implements InputFilterAwareInterface
{
    public $postid;
    public $postoptionid;
    public $title;
    public $subtitle;
    public $description;
    public $seoUrl;
    public $expireDate;
    public $seoKeywords;
    public $seoDescription;
    public $status;
    public $moduleId;
    public $categories;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->postid    		= (isset($data['postid'])) ? $data['postid'] : null;
        $this->postoptionid    	= (isset($data['postoptionid'])) ? $data['postoptionid'] : null;
        $this->title 	 		= (isset($data['title'])) ? $data['title'] : null;
        $this->subtitle 	    = (isset($data['subtitle'])) ? $data['subtitle'] : null;
        $this->description  	= (isset($data['description']))  ? $data['description'] : null;
        $this->seoUrl           = (isset($data['seoUrl']))  ? $data['seoUrl']  : null;
        $this->expireDate  	    = (isset($data['expireDate']))  ? $data['expireDate'] : null;
        $this->seoKeywords  	= (isset($data['seoKeywords']))  ? $data['seoKeywords'] : null;
        $this->seoDescription  	= (isset($data['seoDescription']))  ? $data['seoDescription'] : null;
        $this->status  	        = (isset($data['status']))  ? $data['status'] : null;
        $this->moduleId  	    = (isset($data['moduleId']))  ? $data['moduleId'] : null;
        $this->categories       = (isset($data['categories']))  ? $data['categories'] : null;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    /**
     * @param \Zend\InputFilter\InputFilterInterface $inputFilter
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

            $inputFilter->add($factory->createInput(array(
                            'name'     => 'id',
                            'required' => false,
                            'filters'  => array(
                                array('name' => 'Int'),
                            ),
            )));

            $inputFilter->add($factory->createInput(array(
                            'name'     => 'title',
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
                                                                    'max'      => 255,
                                                    ),
                                            ),
                            ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'subtitle',
                'required' => false,
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
                            'max'      => 255,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'seoDescription',
                'required' => false,
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
                            'max'      => 255,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'seoKeywords',
                'required' => false,
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
                            'max'      => 255,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput([
                'name' => 'categories',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                ),
            ]));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'description',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'expireDate',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'moduleId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
