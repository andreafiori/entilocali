<?php

namespace ModelModuleTest\Model\Logs;

use ModelModule\Model\Log\LogWriter;
use ModelModuleTest\TestSuite;

class LogWriterTest extends TestSuite
{
    /**
     * @var LogWriter
     */
    private $logWriter;

    private $logToWrite;

    protected function setUp()
    {
        parent::setUp();

        $this->logWriter = new LogWriter($this->getEntityManagerMock()->getConnection());

        $this->logToWrite = array(
            'user_id'   => 1,
            'module_id' => 2,
            'message'   => "John Doe, errore deleting article: My sample post ",
            'type'      => 'error',
            'backend'   => 1,
        );
    }

    public function testWriteLog()
    {
        $this->assertTrue( $this->logWriter->writeLog($this->logToWrite) );
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testWriteLogThrowsExceptionForInvalidData()
    {
        unset($this->logToWrite['module_id']);

        $this->logWriter->writeLog($this->logToWrite);
    }
}