<?php

namespace ModelModule\Model\Sezioni;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\File\Size;

class SezioniFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $nome;
    public $image;
    public $lingua;
    public $colonna;
    public $attivo;
    public $blocco;
    public $posizione;
    public $isAmmTrasparente;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id               = (isset($data['id']))               ? $data['id']               : null;
        $this->nome             = (isset($data['nome']))             ? $data['nome']             : null;
        $this->url              = (isset($data['url']))              ? $data['url']              : null;
        $this->image            = (isset($data['image']))            ? $data['image']            : null;
        $this->lingua           = (isset($data['lingua']))           ? $data['lingua']           : null;
        $this->colonna          = (isset($data['colonna']))          ? $data['colonna']          : null;
        $this->attivo           = (isset($data['attivo']))           ? $data['attivo']           : null;
        $this->blocco           = (isset($data['blocco']))           ? $data['blocco']           : null;
        $this->posizione        = (isset($data['posizione']))        ? $data['posizione']        : null;
        $this->isAmmTrasparente = (isset($data['isAmmTrasparente'])) ? $data['isAmmTrasparente'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'isAmmTrasparente',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add($factory->createInput([
                'name' => 'nome',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(

                ),
            ]));

            $inputFilter->add($factory->createInput(array(
                'name' => 'url',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
            )));

            $inputFilter->add($factory->createInput([
                'name' => 'lingua',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                ),
            ]));

            $inputFilter->add($factory->createInput([
                'name' => 'image',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    /*
                    array (
                        'name' => 'Zend\Validator\File\Size',
                        'options' => array(
                            'max' => '20000',
                        ),
                    ),
                    array (
                        'name' => 'Zend\Validator\File\ExcludeExtension',
                        'options' => array(
                            'jpg,jpeg,gif,png',
                        ),
                    ),
                    array (
                        'name' => 'Zend\Validator\File\MimeType',
                        'options' => array(
                            'image/jpg',
                        ),
                    ),
                    */
                ),
            ]));

            $inputFilter->add($factory->createInput([
                'name' => 'colonna',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    array (
                        'name' => 'InArray',
                        'options' => array(
                            'haystack' => array('sx','dx'),
                            'messages' => array(
                                'notInArray' => 'The element was not in array'
                            ),
                        ),
                    ),
                ),
            ]));

            $inputFilter->add($factory->createInput([
                'name' => 'attivo',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    array (
                        'name' => 'InArray',
                        'options' => array(
                            'haystack' => array(0,1),
                            'messages' => array(
                                'notInArray' => 'undefined'
                            ),
                        ),
                    ),
                ),
            ]));

            $inputFilter->add($factory->createInput([
                'name' => 'blocco',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                ),
            ]));

            $inputFilter->add($factory->createInput([
                'name' => 'posizione',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => '1',
                        ),
                    ),
                ),
            ]));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
