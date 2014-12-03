<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Admin\Model\DataTable\DataTableAbstract;

class AmministrazioneTrasparenteDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
    }
}