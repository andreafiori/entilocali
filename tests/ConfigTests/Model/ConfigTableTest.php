<?php

namespace ConfigTest\Model;

use Config\Model\Config;
use Config\Model\ConfigTable;

use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class ConfigTableTest extends PHPUnit_Framework_TestCase
{
	private $arrayRecordSample;
	
	protected function setUp()
	{
		$this->arrayRecordSample = array(
				'id' => 123,
				'value' => 'My value',
				'isadmin' => 0,
				'rifmodule' => 1,
				'rifchannel' => 1,
				'riflanguage' => 1
		);
	}
	
	public function testFetchAllReturnsAllConfigs()
	{
		$resultSet        = new ResultSet();
		$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
		$mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));

        $configTable = new ConfigTable($mockTableGateway);

        $this->assertSame($resultSet, $configTable->fetchAll());
    }
    
    public function testCanRetrieveAnConfigByItsId()
    {
        $config = new Config();
        $config->exchangeArray( $this->arrayRecordSample );

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Config());
        $resultSet->initialize(array($config));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $configTable = new ConfigTable($mockTableGateway);

        $this->assertSame($config, $configTable->getConfig(123));
    }
    
    public function testCanDeleteAnConfigByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('delete')
                         ->with(array('id' => 123));

        $configTable = new ConfigTable($mockTableGateway);
        $configTable->deleteConfig(123);
    }
    /*
    public function testSaveConfigWillInsertNewConfigsIfTheyDontAlreadyHaveAnId()
    {
    	unset( $this->arrayRecordSample['id'] );
    	$this->arrayRecordSample = array_filter( $this->arrayRecordSample );
    	
        $config = new Config();
        $config->exchangeArray($this->arrayRecordSample);

		$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('insert')
                         ->with( $this->arrayRecordSample );

		$configTable = new ConfigTable($mockTableGateway);
		$configTable->saveConfig($config);
    }
	
    public function testSaveConfigWillUpdateExistingConfigsIfTheyAlreadyHaveAnId()
    {
        $config     = new Config();
        $config->exchangeArray($this->arrayRecordSample);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Config());
        $resultSet->initialize(array($config));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
                         ->method('update')
                         ->with(array('value' => 'My value'),
                                array('id' => 123));
		
        $configTable = new ConfigTable($mockTableGateway);
        $configTable->saveConfig($config);
    }
	*/
    public function testExceptionIsThrownWhenGettingNonexistentConfig()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Config());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $configTable = new ConfigTable($mockTableGateway);

        try
        {
            $configTable->getConfig(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}