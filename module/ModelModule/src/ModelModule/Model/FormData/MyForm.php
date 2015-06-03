<?php

namespace ModelModule\Model\FormData;

use Zend\Form\Form as ZendForm;

class MyForm extends ZendForm
{
    /**
     * Override isValid() to set an validation group of all elements that do not
     * have an 'exclude' option, if at least one element has this option set.
     *
     * @return boolean
     */
    public function isValid()
    {
        if ($this->hasValidated) {
            return $this->isValid;
        }

        if ($this->getValidationGroup() === null) {
            // Add all non-excluded elements to the validation group
            $validationGroup = null;
            foreach ($this->getElements() as $element) {
                if ($element->getOption('exclude') !== true) {
                    $validationGroup[] = $element->getName();
                }
            }
            if ($validationGroup) {
                $this->setValidationGroup($validationGroup);
            }
        }

        return parent::isValid();
    }
}