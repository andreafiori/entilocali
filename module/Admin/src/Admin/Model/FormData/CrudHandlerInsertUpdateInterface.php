<?php

namespace Admin\Model\FormData;

use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  20 March 2015
 */
interface CrudHandlerInsertUpdateInterface
{
    public function insert(InputFilterAwareInterface $formData);

    public function update(InputFilterAwareInterface $formData);

    public function logInsertOk();

    public function logInsertKo($message = null);

    public function logUpdateOk();

    public function logUpdateKo($message = null);
}