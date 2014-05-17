<?php

namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @author Andrea Fiori
 * @since  08 February 2014
 */
class PostsFormInputFilter implements InputFilterAwareInterface
{
    public $idpost, $idpostoption, $title, $description, $seoUrl, $seoKeywords, $seoDescription;

    protected $inputFilter;

    public function exchangeArray($data)
    {
            $this->idpost    		= (isset($data['idpost'])) ? $data['idpost'] : null;
            $this->idpostoption    	= (isset($data['idpostoption'])) ? $data['idpostoption'] : null;
            $this->title 	 		= (isset($data['title'])) ? $data['title'] : null;
            $this->description  	= (isset($data['description']))  ? $data['description']  : null;
            $this->seoUrl			= (isset($data['seoUrl']))  ? $data['seoUrl']  : null;
            $this->seoKeywords  	= (isset($data['seoKeywords']))  ? $data['seoKeywords']  : null;
            $this->seoDescription  	= (isset($data['seoDescription']))  ? $data['seoDescription']  : null;
    }

    public function getArrayCopy()
    {
            return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
            throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {

            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                            'name'     => 'id',
                            'required' => true,
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
                            ),
                            'validators' => array(
                                            array(
                                                            'name'    => 'StringLength',
                                                            'options' => array(
                                                                            'encoding' => 'UTF-8',
                                                                            'min'      => 1,
                                                                            'max'      => 100,
                                                            ),
                                            ),
                            ),
            )));

            $inputFilter->add($factory->createInput(array(
                            'name'     => 'seoKeywords',
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
                                                                            'max'      => 100,
                                                            ),
                                            ),
                            ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}