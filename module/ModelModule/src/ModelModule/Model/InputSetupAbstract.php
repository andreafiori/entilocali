<?php

namespace ModelModule\Model;

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