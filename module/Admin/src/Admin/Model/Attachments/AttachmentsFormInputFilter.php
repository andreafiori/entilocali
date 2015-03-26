<?php

namespace Admin\Model\Attachments;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AttachmentsFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $attachmentFile;
    public $title;
    public $description;
    public $expireDate;
    public $s3_directory;
    public $moduleId;
    public $userId;
    public $attachmentId;
    public $referenceId;
    
    protected $inputFilter;

    /**
     * @param $data
     */
    public function exchangeArray($data)
    {
        $this->title           = (isset($data['title']))            ? $data['title']            : null;
        $this->description     = (isset($data['description']))      ? $data['description']      : null;
        $this->attachmentFile  = (isset($data['attachmentFile']))   ? $data['attachmentFile']   : null;
        $this->expireDate      = (isset($data['expireDate']))       ? $data['expireDate']       : null;
        $this->s3_directory    = (isset($data['s3_directory']))     ? $data['s3_directory']     : null;
        $this->moduleId        = (isset($data['moduleId']))         ? $data['moduleId']         : null;
        $this->userId          = (isset($data['userId']))           ? $data['userId']           : null;
        $this->attachmentId    = (isset($data['attachmentId']))     ? $data['attachmentId']     : null;
        $this->referenceId     = (isset($data['referenceId']))      ? $data['referenceId']      : null;
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
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {

            $inputFilter = new InputFilter();

            $factory     = new InputFactory();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add($factory->createInput([
                'name' => 'attachmentFile',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                /*
                'validators' => array(
                    array (
                        'name' => 'Zend\Validator\File\Size',
                        'options' => array(
                            'max' => '10',
                        ),
                    ),
                    array (
                        'name' => 'Zend\Validator\File\ExcludeExtension',
                        'options' => array(
                            'jpg,jpeg,gif,png,rar,pdf,pdfa,zip,doc,docx,rtf,xls,xlsx,csv,txt',
                        ),
                    ),
                    array (
                        'name' => 'Zend\Validator\File\MimeType',
                        'options' => array(
                            'image',
                        ),
                    ),
                ),
                */
            ]));

            $inputFilter->add(
                $factory->createInput(array(
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
                ))
            );
            
            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'description',
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
                            ),
                        ),
                    ),
                ))
            );
             
            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'title',
                    'required' => true,
                ))
            );

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'description',
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
                ))
            );

            $inputFilter->add(array(
                'name'     => 'referenceId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'moduleId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
            
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
