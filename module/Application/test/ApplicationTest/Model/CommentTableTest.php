<?php

namespace Application\Model;

use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class CommentTableTest extends PHPUnit_Framework_TestCase
{
	private $sampleComment;
	
	public function setUp()
	{
		$this->sampleComment = array('id' => 123, 'message' => 'The Comment message is here!', 'rifuser' => 123);
	}
	
    public function testFetchAllReturnsNull()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
        									 array('select'), array(), '', false);
        $mockTableGateway->expects($this->any())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));

        $commentTable = new CommentTable($mockTableGateway);
		
        $this->assertEmpty( $commentTable->fetchAll() );
    }
    
    public function testCanRetrieveACommentByItsId()
    {
        $comment = new Comment();
        $comment->exchangeArray( $this->sampleComment );

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Comment());
        $resultSet->initialize(array($comment));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $commentTable = new CommentTable($mockTableGateway);

        $this->assertSame($comment, $commentTable->getComment(123));
    }

    public function testCanDeleteACommentByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('delete')
                         ->with(array('id' => 123));

        $commentTable = new CommentTable($mockTableGateway);
        $commentTable->deleteComment(123);
    }
	/*
    public function testSaveCommentWillInsertNewCommentIfTheyDontAlreadyHaveAnId()
    {
    	$this->sampleComment = array_slice($this->sampleComment, 1, count($this->sampleComment));
        $comment = new Comment();
        $comment->exchangeArray($this->sampleComment);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('insert')
                         ->with($this->sampleComment);

        $commentTable = new CommentTable($mockTableGateway);
        $commentTable->saveComment($comment);
    }
	*/
    public function testSaveCommentWillUpdateExistingCommentsIfTheyAlreadyHaveAnId()
    {
        $commentData = $this->sampleComment;
        $comment = new Comment();
        $comment->exchangeArray($commentData);
        
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Comment());
        $resultSet->initialize(array($comment));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
                         ->method('update')
                         ->with($this->sampleComment,
                                array('id' => 123));

        $commentTable = new CommentTable($mockTableGateway);
        $commentTable->saveComment($comment);
    }

    public function testExceptionIsThrownWhenGettingNonexistentComment()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Comment());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $commentTable = new CommentTable($mockTableGateway);

        try
        {
            $commentTable->getComment(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}