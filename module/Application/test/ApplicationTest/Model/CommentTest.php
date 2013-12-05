<?php

namespace CommentTest\Model;

use Application\Model\Comment;

use PHPUnit_Framework_TestCase;

class CommentTest extends PHPUnit_Framework_TestCase
{
	private $sampleUser;
	
	public function setUp()
	{
		$this->sampleUser = array( 'id' => 123, 'message' => 'some message', 'rifuser'  => 123 );
	}
	
    public function testCommentInitialState()
    {
        $comment = new Comment();
        $this->commentNullAssertion($comment);
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $comment = new Comment();
        $data = array( $this->sampleUser );

        $comment->exchangeArray($data);
        
        $this->assertSame($data['id'], $comment->id, '"title" was not set correctly');
        $this->assertSame($data['message'], $comment->message, '"message" was not set correctly');
        $this->assertSame($data['rifuser'], $comment->rifuser, '"rifuser" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $comment = new Comment();

        $comment->exchangeArray( $this->sampleUser );
        $comment->exchangeArray(array());

        $this->commentNullAssertion($comment);
    }
	
	    private function commentNullAssertion(Comment $comment)
	    {
	    	$this->assertNull($comment->id, '"id" should have defaulted to null');
	    	$this->assertNull($comment->message, '"message" should have defaulted to null');
	    	$this->assertNull($comment->rifuser, '"rifuser" should have defaulted to null');
	    }
	
}