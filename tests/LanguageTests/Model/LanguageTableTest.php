<?php

namespace Language\Model;

use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class LanguageTableTest extends PHPUnit_Framework_TestCase
{
	private $arraySample;
	
	public function setUp()
	{
		$this->arraySample = array('language' => 'English',
                                    'abbrev1'  => 'en',
        							'abbrev2'  => 'eng',
        							'abbrev3' => 'english',
									/*
									'defaultlang' => 1,
									'defaultlang_admin' => 1,
									'encoding' => 'UTF-8',
									'flag' => 'eng.gif',
									'active' => 1,
									'channel_id' => 1
									*/
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

        $LanguageTable = new LanguageTable($mockTableGateway);

        $this->assertSame($resultSet, $LanguageTable->fetchAll());
    }
    
    public function testCanRetrieveAnLanguageByItsId()
    {
    	$this->arraySample['id'] = 123;
        $Language = new Language();
        $Language->exchangeArray($this->arraySample);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Language());
        $resultSet->initialize(array($Language));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $LanguageTable = new LanguageTable($mockTableGateway);

        $this->assertSame($Language, $LanguageTable->getLanguage(123));
    }

    public function testCanDeleteAnLanguageByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('delete')
                         ->with(array('id' => 123));

        $LanguageTable = new LanguageTable($mockTableGateway);
        $LanguageTable->deleteLanguage(123);
    }

    public function testSaveLanguageWillInsertNewLanguagesIfTheyDontAlreadyHaveAnId()
    {
        $LanguageData = $this->arraySample;
        $Language     = new Language();
        $Language->exchangeArray($LanguageData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('insert')
                         ->with($LanguageData);

        $LanguageTable = new LanguageTable($mockTableGateway);
        $LanguageTable->saveLanguage($Language);
    }

    public function testSaveLanguageWillUpdateExistingLanguagesIfTheyAlreadyHaveAnId()
    {
        $LanguageData = array('id' => 123, 'language' => 'English', 'abbrev1' => 'en', 'abbrev2' => 'eng', 'abbrev3' => 'english');
        $Language     = new Language();
        $Language->exchangeArray($LanguageData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Language());
        $resultSet->initialize(array($Language));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
                         ->method('update')
                         ->with(array('language' => 'English', 'abbrev1' => 'en', 'abbrev2' => 'eng', 'abbrev3' => 'english'),
                                array('id' => 123));

        $LanguageTable = new LanguageTable($mockTableGateway);
        $LanguageTable->saveLanguage($Language);
    }

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

        $LanguageTable = new LanguageTable($mockTableGateway);

        try
        {
            $LanguageTable->getLanguage(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}