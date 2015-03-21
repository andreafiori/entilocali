<?php

namespace Admin\Model\Contenuti;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @author Andrea Fiori
 * @since  19 March 2015
 */
class ContenutiFormInputFilter implements InputFilterAwareInterface
{
    private $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id    = (isset($data['id']))    ? $data['id']     : null;
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("This method is unused");
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('sottosezione' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'titolo',
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
                            'max'      => 255,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}