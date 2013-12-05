<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Comment;

class CommentTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		if (!$this->tableGateway->getSql()) return;
		$sqlSelect = $this->tableGateway->getSql()->select();
		$sqlSelect->columns( array('*') );
		$sqlSelect->join('user', 'rifuser = user.id', array('name', 'email'), 'left');
		$sqlSelect->order('comment.id DESC');
		return $this->tableGateway->selectWith($sqlSelect);
	}

	public function getComment($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
	
	public function saveComment(Comment $comment)
	{
		$data = array(
				'id' => $comment->id,
				'message' => $comment->message,
				'rifuser'  => $comment->rifuser,
		);

		$id = (int) $comment->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getComment($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Form id does not exist');
			}
		}
	}

	public function deleteComment($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}
