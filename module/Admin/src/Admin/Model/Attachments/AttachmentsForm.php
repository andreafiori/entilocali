<?php

namespace Admin\Model\Attachments;

use Zend\Form\Form;

/**      
 * @author Andrea Fiori
 * @since  20 August 2014
 */
class AttachmentsForm extends Form
{
    public function addInputFile()
    {
        $this->add(array(
                        'name' => 'attachmentFile',
                        'type' => 'Zend\Form\Element\File',
                        'options' => array( 'label' => '* File' ),
                        'attributes' => array(
                                        'required'  => 'required',
                                        'title'     => 'Inserisci file allegato',
                                        'id'        => 'attachmentFile',
                        )
        ));
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
                        'type' => 'Date',
                        'name' => 'expireDate',
                        'options' => array(
                                'label' => 'Scadenza',
                                'format' => 'Y-m-d',
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
                        'name'          => 'attachmentId',
                        'attributes'    => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type'          => 'Zend\Form\Element\Hidden',
                        'name'          => 'referenceId',
                        'attributes'    => array("class"=>'hiddenField')
        ));
    }
}
