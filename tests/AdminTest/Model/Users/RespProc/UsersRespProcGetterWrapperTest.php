<?php

namespace AdminTest\Model\Users\RespProc;

use ApplicationTest\TestSuite;
use Admin\Model\Users\RespProc\UsersRespProcGetterWrapper;
use Admin\Model\Users\RespProc\UsersRespProcGetter;

/**
 * @author Andrea Fiori
 * @since  02 April 2015
 */
class UsersRespProcGetterWrapperTest extends TestSuite
{
    /**
     * @var UsersRespProcGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new UsersRespProcGetterWrapper( new UsersRespProcGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
