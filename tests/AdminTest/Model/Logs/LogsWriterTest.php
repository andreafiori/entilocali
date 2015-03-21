<?php

namespace AdminTest\Model\Logs;

use Admin\Model\Logs\LogsWriter;
use ApplicationTest\TestSuite;

class LogWriterTest extends TestSuite
{
    /**
     * @var LogsWriter
     */
    private $logWriter;

    private $logToWrite;

    protected function setUp()
    {
        parent::setUp();

        $this->logWriter = new LogsWriter($this->getEntityManagerMock()->getConnection());

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
     * @expectedException \Application\Model\NullException
     */
    public function testWriteLogThrowsExceptionForInvalidData()
    {
        unset($this->logToWrite['module_id']);

        $this->logWriter->writeLog($this->logToWrite);
    }
}