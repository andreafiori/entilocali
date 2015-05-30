<?php

namespace ModelModule\Model\Attachments;

use Zend\Form\Element;
use Zend\Form\ElementInterface;
use Zend\Form\Form;

class AttachmentsForm extends Form
{
    public function addInputFile()
    {
        $this->add( $this->getInputFileArray() );
    }

    public function addInputFileNotRequired()
    {
        $element = $this->getInputFileArray();

        unset($element['attributes']['required']);

        $this->add($element);
    }

        /**
         * @return array
         */
        private function getInputFileArray()
        {
            return array(
                'name' => 'attachmentFile',
                'type' => 'Zend\Form\Element\File',
                'options' => array( 'label' => '* File' ),
                'attributes' => array(
                    'required'  => 'required',
                    'title'     => 'Inserisci file allegato',
                    'id'        => 'attachmentFile',
                )
            );
        }
    
    public function addSecondaryFields()
    {
        $this->add(array(
                        'name' => 'title',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Titolo' ),
                        'attributes' => array(
                                    'id' => 'title',
                                    'title' => 'Inserisci titolo allegato',
                                    'placeholder' => 'Titolo...',
                                    'required' => 'required',
                        )
        ));
        
        $this->add(array(
                        'name' => 'description',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Descrizione' ),
                        'attributes' => array(
                                    'id'            => 'description',
                                    'placeholder'   => 'Descrizione...',
                                    'title'         => 'Inserisci descrizione file allegato',
                                    'rows'          => 8,
                                    'cols'          => 35
                        )
        ));
        
        $this->add(array(
                        'type' => 'DateTime',
                        'name' => 'expireDate',
                        'options' => array(
                                'label' => 'Scadenza',
                                'format' => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'required'      => 'required',
                                'id'            => 'expireDate',
                                'placeholder'   => 'Seleziona data scadenza',
                                'title'         => 'Seleziona data di scadenza file allegato'
                        )
        ));
        
        $this->add(array(
                        'type'       => 'Zend\Form\Element\Hidden',
                        'name'       => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type'       => 'Zend\Form\Element\Hidden',
                        'name'       => 's3_directory',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type'       => 'Zend\Form\Element\Hidden',
                        'name'       => 'moduleId',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type'       => 'Zend\Form\Element\Hidden',
                        'name'       => 'userId',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type'          => 'Zend\Form\Element\Hidden',
                        'name'          => 'attachmenOptionId',
                        'attributes'    => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type'          => 'Zend\Form\Element\Hidden',
                        'name'          => 'referenceId',
                        'attributes'    => array("class"=>'hiddenField')
        ));
    }
}
