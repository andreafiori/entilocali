<?php

namespace Admin\Model\DataTable;

use \Admin\Model\InputSetupAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
abstract class DataTableAbstract extends InputSetupAbstract
{
    protected $title, $description;
    
    protected $template = 'datatable/datatable.phtml';
}