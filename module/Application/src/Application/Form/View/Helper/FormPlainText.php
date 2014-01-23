<?php

namespace Application\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

class FormPlainText extends AbstractHelper
{	
	public function render(ElementInterface $element)
	{
		return $element->getValue();
	}
	
	public function __invoke(ElementInterface $element = null)
	{
		return $this->render($element);
	}
}