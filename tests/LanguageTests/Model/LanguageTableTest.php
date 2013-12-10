<?php

namespace LanguageTest\Model;

use Language\Model\Language;
use Language\Model\LanguageTable;

use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class LanguageTableTest extends PHPUnit_Framework_TestCase
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

	public function testFetchAllReturnsAllLanguages()
	{
		$resultSet        = new ResultSet();
		$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
				array('select'), array(), '', false);
		$mockTableGateway->expects($this->once())
		->method('select')
		->with()
		->will($this->returnValue($resultSet));

		$languageTable = new LanguageTable($mockTableGateway);

		$this->assertSame($resultSet, $languageTable->fetchAll());
	}

	public function testCanRetrieveAnLanguageByItsId()
	{
		$language = new Language();
		$language->exchangeArray( $this->arrayRecordSample );

		$resultSet = new ResultSet();
		$resultSet->setArrayObjectPrototype(new Language());
		$resultSet->initialize(array($language));

		$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
		$mockTableGateway->expects($this->once())
		->method('select')
		->with(array('id' => 123))
		->will($this->returnValue($resultSet));

		$languageTable = new LanguageTable($mockTableGateway);

		$this->assertSame($language, $languageTable->getLanguage(123));
	}

	public function testCanDeleteAnLanguageByItsId()
	{
		$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
		$mockTableGateway->expects($this->once())
		->method('delete')
		->with(array('id' => 123));

		$languageTable = new LanguageTable($mockTableGateway);
		$languageTable->deleteLanguage(123);
	}
	/*
	 public function testSaveLanguageWillInsertNewLanguagesIfTheyDontAlreadyHaveAnId()
	 {
	unset( $this->arrayRecordSample['id'] );
	$this->arrayRecordSample = array_filter( $this->arrayRecordSample );
	 
	$language = new Language();
	$language->exchangeArray($this->arrayRecordSample);

	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
	$mockTableGateway->expects($this->once())
	->method('insert')
	->with( $this->arrayRecordSample );

	$languageTable = new LanguageTable($mockTableGateway);
	$languageTable->saveLanguage($language);
	}

	public function testSaveLanguageWillUpdateExistingLanguagesIfTheyAlreadyHaveAnId()
	{
	$language     = new Language();
	$language->exchangeArray($this->arrayRecordSample);

	$resultSet = new ResultSet();
	$resultSet->setArrayObjectPrototype(new Language());
	$resultSet->initialize(array($language));

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

	$languageTable = new LanguageTable($mockTableGateway);
	$languageTable->saveLanguage($language);
	}
	*/
	public function testExceptionIsThrownWhenGettingNonexistentLanguage()
	{
		$resultSet = new ResultSet();
		$resultSet->setArrayObjectPrototype(new Language());
		$resultSet->initialize(array());

		$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
		$mockTableGateway->expects($this->once())
		->method('select')
		->with(array('id' => 123))
		->will($this->returnValue($resultSet));

		$languageTable = new LanguageTable($mockTableGateway);

		try
		{
			$languageTable->getLanguage(123);
		}
		catch (\Exception $e)
		{
			$this->assertSame('Could not find row 123', $e->getMessage());
			return;
		}

		$this->fail('Expected exception was not thrown');
	}
}