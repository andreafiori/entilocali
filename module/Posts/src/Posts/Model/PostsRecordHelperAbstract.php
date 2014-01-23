<?php

namespace Posts\Model;

/**
 * 
 * @author Andrea Fiori
 * @since  21 January 2014
 */
abstract class PostsRecordHelperAbstract {

	protected $postsRecords, $postsRecordsCount;

	protected $setupManager;

	protected $partialLayoutTemplate;

	protected $remotelinkWeb;

	public function getRemotelinkWeb()
	{
		return $this->remotelinkWeb;
	}

	public function getSetupManager()
	{
		return $this->setupManager;
	}

	public function getPartialLayoutTemplate()
	{
		return $this->partialLayoutTemplate;
	}

	public function getPostsRecords()
	{
		return $this->postsRecords;
	}
}