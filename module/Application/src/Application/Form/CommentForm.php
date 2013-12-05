<?php

namespace Application\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class CommentForm extends Form {
	
	public function __construct($name = null)
	{
		parent::__construct('application');
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype', 'multipart/form-data');
		
        $this->add(array(
			'name' => 'name',
			'type' => 'Text',
			'options' => array( 'label' => 'Name' ),
        	'attributes' => array(
        		'required' => 'required',
        		'title' => 'Insert your name',
        	)
         ));

        $this->add(array(
         		'name' => 'email',
         		'type' => 'Zend\Form\Element\Email',
         		'options' => array(
         			'label' => 'Email',
         		),
        		'attributes' => array(
        			'required' => 'required',
        			'title' => 'Insert your email'
        		)
         ));
         
        $this->add(array(
         		'name' => 'message',
         		'type' => 'Zend\Form\Element\Textarea',
         		'options' => array(
					'label' => 'Message',
         		),
        		'attributes' => array(
        			'required' => 'required',
        			'title' => 'Insert a message',
        			'rows' => 8,
        			'cols' => 35
        		)
         ));
         
        /* Captcha */
		$captcha = new Element\Captcha('captcha');
		$captcha->setCaptcha(new Captcha\Dumb());
        $this->add($captcha);
        
        $this->add(array(
         		'name' => 'submit',
         		'attributes' => array(
         			'type'  => 'submit',
         			'value' => 'Send',
         			'id' => 'submitbutton',
         			'class' => 'btn btn-primary'
         		),
         ));
	}

}
