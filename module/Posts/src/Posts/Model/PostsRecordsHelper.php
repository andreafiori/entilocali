<?php

namespace Posts\Model;

use Setup\SetupManager;
use Setup\NullException;

/**
 * Given postsData, set the additional infos on the arrays...
 * @author Andrea fiori
 * @since  05 January 2014
 */
class PostsRecordsHelper
{
	private $postsRecords, $postsRecordsCount;
	private $setupManager;
	private $partialLayoutTemplate;
	private $remotelinkWeb;

	public function __construct(array $postsRecords)
	{
		$this->postsRecords = $postsRecords;
		$this->postsRecordsCount = count($postsRecords);
	}

	public function setRemotelinkWeb($remotelinkWeb)
	{
		$this->remotelinkWeb = $remotelinkWeb;
	}
	
	public function getRemotelinkWeb()
	{
		return $this->remotelinkWeb;
	}
	
	public function getSetupManager()
	{
		return $this->setupManager;
	}
	
	public function setSetupManager(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}

	public function setAdditionalArrayElements()
	{
		if ( !$this->getPostsRecords() ) {
			// throw new NullException('Posts Records are not set');
			return false;
		}
		
		$postsRecords = array();
		foreach($this->getPostsRecords() as $record) {
			$record['linkDetails'] = $this->getLinkDetails($record);
			$postsRecords[] = $record;
		}
		
		if (isset($postsRecords[0]['typeofpost'])) {
			$this->assignLayout($postsRecords[0]['typeofpost']);
		}
		
		$this->postsRecords = $postsRecords;
		
		return $postsRecords;
	}
	
		/**
		 * 
		 * @param unknown $record
		 * @return string
		 */
		private function getLinkDetails($record)
		{
			if ($record['name'] == $record['title'] and isset($record['seoUrl']) ) {
				//unset($record['seoUrl']);
			} elseif ( isset($record['seoUrl']) ) {
				$record['seoUrl'] = $record['seoUrl'].'/';
			}
			
			return $this->remotelinkWeb.$this->getSetupManager()->getSetupManagerLanguages()->getLanguageAbbreviation().'/'. \Setup\StringRequestDecoder::slugify($record['name']).'/'.$record['seoUrl'];
		}
	
	public function assignLayout($typeOfPost)
	{
		if (!$typeOfPost) return false;
		
		if ($this->postsRecordsCount == 1) {
			$this->partialLayoutTemplate = $typeOfPost.'/detail.phtml';
		} elseif ($this->postsRecordsCount > 1) {
			$this->partialLayoutTemplate = $typeOfPost.'/list.phtml';
		}
		
		return $this->partialLayoutTemplate;
	}
	
	public function setPartialLayoutTemplate($layout)
	{
		$this->partialLayoutTemplate = $layout;
		
		return $this->partialLayoutTemplate;
	}

	public function getPartialLayoutTemplate()
	{
		return $this->partialLayoutTemplate;
	}
	
	public function getPostsRecords()
	{
		return $this->postsRecords;
	}

	public function sortPostsByAlias($sort = false)
	{
		if (!$sort) {
			return false;
		}
		
		$postsAlias = array();
		foreach($this->getPostsRecords() as $posts)
		{
			if (isset($posts['alias'])) {
				$postsAlias[ $posts['alias'] ] = $posts;
			}
		}
		$this->postsRecords = $postsAlias;
	
		return $this->postsRecords;
	}
}