<?php

namespace Application\Form\View\Helper;

use Application\Form\Element;
use Zend\Form\View\Helper\FormElement as BaseFormElement;
use Zend\Form\ElementInterface;

class FormElement extends BaseFormElement
{
    public function render(ElementInterface $element)
    {
        $renderer = $this->getView();
        if (!method_exists($renderer, 'plugin')) {
            return '';
        }

        if ($element instanceof Element\PlainText) {
            $helper = $renderer->plugin('form_plain_text');

            return $helper($element);
        }
        
        if ($element instanceof Element\CheckboxTree) {
            $helper = $renderer->plugin('form_checkbox_tree');
            
            return $helper($element);
        }

        return parent::render($element);
    }
}