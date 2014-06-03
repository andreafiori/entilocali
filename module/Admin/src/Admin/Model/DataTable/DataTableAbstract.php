<?php

namespace Admin\Model\DataTable;

use Admin\Model\InputSetupTemplateAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
abstract class DataTableAbstract extends InputSetupTemplateAbstract
{
    protected $title;
    protected $description;
    protected $template = 'datatable/datatable.phtml';
}