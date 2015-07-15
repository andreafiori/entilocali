<?php

namespace ModelModule\Model\Attachments;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Attachments Admin Form Validator
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
    public $attachmenOptionId;
    public $referenceId;
    public $status;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param $data
     */
    public function exchangeArray($data)
    {
        $this->id                   = (isset($data['id']))                  ? $data['id']                : null;
        $this->title                = (isset($data['title']))               ? $data['title']             : null;
        $this->description          = (isset($data['description']))         ? $data['description']       : null;
        $this->attachmentFile       = (isset($data['attachmentFile']))      ? $data['attachmentFile']    : null;
        $this->expireDate           = (isset($data['expireDate']))          ? $data['expireDate']        : null;
        $this->s3_directory         = (isset($data['s3_directory']))        ? $data['s3_directory']      : null;
        $this->moduleId             = (isset($data['moduleId']))            ? $data['moduleId']          : null;
        $this->userId               = (isset($data['userId']))              ? $data['userId']            : null;
        $this->attachmenOptionId    = (isset($data['attachmenOptionId']))   ? $data['attachmenOptionId'] : null;
        $this->referenceId          = (isset($data['referenceId']))         ? $data['referenceId']       : null;
        $this->status               = (isset($data['status']))              ? $data['status']            : null;
    }

    /**
     * @inheritdoc
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
                'required' => false,
                'filters' => array(

                ),
            ]));

            $inputFilter->add(
                $factory->createInput(array(
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
                                'max'      => 100,
                            ),
                        ),
                    ),
                ))
            );

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'description',
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
                                'max'      => 230,
                            ),
                        ),
                    ),
                ))
            );

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'expireDate',
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

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 's3_directory',
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
                ))
            );

            $inputFilter->add(array(
                'name'     => 'attachmenOptionId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'status',
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
