<?php

namespace Admin\Model\FormData;

use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  20 March 2015
 */
interface CrudHandlerInsertUpdateInterface
{
    /**
     * @param InputFilterAwareInterface $formData
     * @return mixed
     */
    public function insert(InputFilterAwareInterface $formData);

    /**
     * @param InputFilterAwareInterface $formData
     * @return mixed
     */
    public function update(InputFilterAwareInterface $formData);

    public function logInsertOk();

    /**
     * @param null $message
     * @return mixed
     */
    public function logInsertKo($message = null);

    public function logUpdateOk();

    /**
     * @param null $message
     * @return mixed
     */
    public function logUpdateKo($message = null);
}