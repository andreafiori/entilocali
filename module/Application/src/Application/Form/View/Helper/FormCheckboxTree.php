<?php

namespace Application\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

/**
 * @author Andrea Fiori
 * @since  19 July 2013
 */
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
        $checkedValues = $element->getOption('checked_value');
        
        $element = '';
        if (is_array($values)) {
            $i = 0;
            foreach($values as $key => $value) {
                $element .= '<div class="checkbox"><label><input type="checkbox" name="'.$name.'[]" id="'.$name.'_'.$i.'" value="'.$key.'"';
                
                if (is_array($checkedValues)) {
                    foreach($checkedValues as $checkedValue) {
                        if ($checkedValue['id'] == $key) {
                            $element .= ' checked';
                            continue;
                        }
                    }
                }
                
                $element .= '> '.$value.'</label></div>';
                $i++;
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
