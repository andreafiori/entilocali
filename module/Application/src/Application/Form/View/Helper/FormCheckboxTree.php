<?php

namespace Application\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

class FormCheckboxTree extends AbstractHelper
{
    /**
     * @param \Zend\Form\ElementInterface $element
     * @return type
     */
    public function render(ElementInterface $element)
    {
        $values = $element->getValue();
        $name = $element->getAttribute('name');
        $checkedValue = $element->getOption('checked_value');
        
        $element = '';
        if (is_array($values)) {
            foreach($values as $key => $value) {
                $element .= '<div class="checkbox"><label><input type="checkbox" name="'.$name.'[]" id="'.$name.'" value="'.$key.'"';
                if ( $checkedValue[0] == $key ) {
                    $element .= ' checked';
                }
                $element .= '> '.$value.'</label></div>';
            }
        }
        
        return $element;
    }

    /**
     * @param \Zend\Form\ElementInterface $element
     * @return type
     */
    public function __invoke(ElementInterface $element = null)
    {
        return $this->render($element);
    }
}

