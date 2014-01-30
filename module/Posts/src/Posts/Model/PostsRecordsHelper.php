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
		if ( !$this->getPostsRecords() ) {
			return false;
		}
		
		$postsRecords = array();
		foreach($this->getPostsRecords() as $record) {
			$record['linkDetails'] = $this->getLinkDetails($record);
			$postsRecords[] = $record;
		}
		
		$this->postsRecords = $postsRecords;
		
		return $postsRecords;
	}
		/**
		 * 
		 * @param array $record
		 * @return string
		 */
		private function getLinkDetails($record)
		{
			if ($record['name'] == $record['title'] and isset($record['seoUrl']) ) {
				//unset($record['seoUrl']);
			} elseif ( isset($record['seoUrl']) ) {
				$record['seoUrl'] = $record['seoUrl'].'/';
			}
			
			$link = $this->remotelinkWeb.$this->getSetupManager()->getSetupManagerLanguages()->getLanguageAbbreviation().'/'. \Setup\StringRequestDecoder::slugify($record['name']).'/'.$record['seoUrl'];
			return $link;
		}
	
	public function setPartialLayoutTemplate($layout)
	{
		$this->partialLayoutTemplate = $layout;

		return $this->partialLayoutTemplate;
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