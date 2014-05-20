<?php

namespace ApplicationTest\Model\FormData;

use ApplicationTest\TestSuite;
use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  19 May 2014
 */
class DataTableAbstractTest extends TestSuite
{
    private $dataTableAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->dataTableAbstract = $this->getMockForAbstractClass('Admin\Model\DataTable\DataTableAbstract', array( $this->getFrontendCommonInput() ) );
    }
}
