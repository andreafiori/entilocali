<?php

namespace Application\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

class FormPlainText extends AbstractHelper
{
    /**
     * @param \Zend\Form\ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element)
    {
        return $element->getValue();
    }

    /**
     * @param ElementInterface $element
     * @return mixed
     */
    public function __invoke(ElementInterface $element = null)
    {
        return $this->render($element);
    }
}