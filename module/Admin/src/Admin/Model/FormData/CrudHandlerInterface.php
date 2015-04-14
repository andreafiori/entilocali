<?php

namespace Admin\Model\FormData;

use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  02 June 2014
 */
interface CrudHandlerInterface
{
    public function __construct();

    /**
     * @param InputFilterAwareInterface $formData
     * @return mixed
     */
    public function validateFormData(InputFilterAwareInterface $formData);
}