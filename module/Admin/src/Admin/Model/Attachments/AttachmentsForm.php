<?php

namespace Admin\Model\Attachments;

use Zend\Form\Form;

/**      
 * @author Andrea Fiori
 * @since  20 August 2014
 */
class AttachmentsForm extends Form
{
    /**
     * @param type $name
     * @param type $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
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
        
        $this->add(array(
                        'name' => 'description',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Descrizione' ),
                        'attributes' => array(
                                    'id' => 'description',
                        )
        ));
        
        $this->add(array(
                        'type'       => 'Zend\Form\Element\Hidden',
                        'name'       => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type'          => 'Zend\Form\Element\Hidden',
                        'name'          => 'attachment',
                        'attributes'    => array("class"=>'hiddenField')
        ));
    }
}
