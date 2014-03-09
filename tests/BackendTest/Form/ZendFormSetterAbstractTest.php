<?php

namespace BackendTest\Form;

use SetupTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  07 March 2014
 */
class ZendFormSetterAbstractTest extends TestSuite
{
	private $zendFormSetterAbstract;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->zendFormSetterAbstract = $this->getMockBuilder('\Backend\Form\ZendFormSetterAbstract')
						                     ->disableOriginalConstructor()
						                     ->getMock();
		$this->zendFormSetterAbstract->expects($this->any())
									 ->method('setInputRecord')
									 ->will($this->returnValue( array('id' => 1) ));
	}
	
	public function testSetLanguageLabels()
	{
		$this->zendFormSetterAbstract->setLanguageLabels();
		
		$this->assertEmpty( $this->zendFormSetterAbstract->getLanguageLabels() );
	}
	
	public function testSetInputRecord()
	{		
		$this->assertEquals($this->zendFormSetterAbstract->setInputRecord( array('id' => 1) ), array('id' => 1) );
	}
}
