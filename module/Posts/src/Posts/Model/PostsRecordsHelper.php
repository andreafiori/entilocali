<?php

namespace Posts\Model;

/**
 * Given postsData, set the additional infos on the arrays...
 * @author Andrea fiori
 * @since  05 January 2014
 */
class PostsRecordsHelper {

	private $postsRecords;

	public function __construct(array $postsRecords)
	{
		$this->postsRecords = $postsRecords;
	}

	public function setAdditionalArrayElements()
	{
		$postsRecords = array();
		foreach($this->postsRecords as $record)
		{
			$record['linkDetails'] = '';
			$postsRecords[] = $record;
		}
	}

	/**
	 * set additional data and sort posts by alias 
	
	public function sortPostsByAlias()
	{
		
	} */
}