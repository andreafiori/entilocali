<?php

namespace Posts\Model;

use Setup\SetupManager;

/**
 * Given postsData, set the additional infos on the arrays...
 * @author Andrea fiori
 * @since  05 January 2014
 */
class PostsRecordsHelper extends PostsRecordHelperAbstract
{
	public function __construct(array $postsRecords)
	{
		$this->postsRecords = $postsRecords;
		$this->postsRecordsCount = count($postsRecords);
	}

	public function setRemotelinkWeb($remotelinkWeb)
	{
		$this->remotelinkWeb = $remotelinkWeb;
	}

	public function setSetupManager(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}

	public function setAdditionalArrayElements()
	{
		$postsRecords = $this->getPostsRecords();
		if ( !is_array($postsRecords) ) {
			return false;
		}
		
		for($i=0; $i < count($postsRecords); $i++) {
			if ( isset($postsRecords[$i]) ) {
				if ( is_array($postsRecords[$i]) ) {
					$postsRecords[$i]['linkDetails'] = $this->getLinkDetails($postsRecords[$i]);
				}
			}
		}
		
		$this->postsRecords = $postsRecords;
		
		return $this->postsRecords;
	}
	
		/**
		 * 
		 * @param array $record
		 * @return string
		 */
		private function getLinkDetails($record)
		{
			if ( isset($record['seoUrl']) ) {
				$record['seoUrl'] = $record['seoUrl'].'/';
			}
			
			return $this->remotelinkWeb.$this->getSetupManager()->getSetupManagerLanguages()->getLanguageAbbreviation().'/'. \Setup\StringRequestDecoder::slugify($record['name']).'/'.$record['seoUrl'];		
		}
	
	public function setPartialLayoutTemplate($layout)
	{
		$this->partialLayoutTemplate = $layout;

		return $this->partialLayoutTemplate;
	}

	public function sortPostsByAlias($sort = false)
	{
		if ( $sort === true ) {
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
}