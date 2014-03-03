<?php

namespace PostsTest\Model;

use Posts\Model\PostsFrontendTemplateGetter;

class PostsFrontendTemplateGetterTest extends \PHPUnit_Framework_TestCase 
{
	private $postsFrontendTemplateGetter;
	
	private $singleRecordForTests;
	
	private $multipleRecordsForTests;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->singleRecordForTests = array( array("id"=>1, "title"=>"My Post") );
		
		$this->multipleRecordsForTests = array( 
					array(
						"id"=>1,
						"title"=>"My first Post",
						"typeofpost" => "content"
					), 
					
					array(
						"id" => 1,
						"title" => "My second Post",
						"typeofpost" => "content"
					)
				);
		
		$this->postsFrontendTemplateGetter = new PostsFrontendTemplateGetter();
	}
	
	public function testSetTemplate()
	{
		$this->assertNotEmpty( $this->postsFrontendTemplateGetter->setTemplate() );
	}
}