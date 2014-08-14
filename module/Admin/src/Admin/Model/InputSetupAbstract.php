<?php

namespace Admin\Model;

/**
 * @author Andrea Fiori
 * @since  20 May 2014
 */
abstract class InputSetupAbstract extends InputSetterGetterAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }
}
