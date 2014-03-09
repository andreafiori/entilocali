<?php

namespace Posts\Model;

/**
 * Get the partial template to load
 * @author Andrea Fiori
 * @since  03 March 2014
 */
class PostsFrontendTemplateGetter
{
	private $records, $recordsCount;
	
	private $getSingleRecord;
	
	private $template;
	
	/**
	 * 
	 * @param array or null $records
	 */
	public function setRecords($records)
	{
		$this->records = $records;
		
		$this->setRecordsCount();
		
		return $this->records;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function setTemplate()
	{
		$records = $this->getRecords();
		
		if ( count($records) > 1 and is_array($records) ) {
			if ($records[0]['template']) {
				return $records[0]['typeofpost'].'/lists/'.$records[0]['template'];
			} else {
				return $records[0]['typeofpost'].'/lists/default.phtml';
			}
		}
		
		if ( isset($records[0]) ) {
			$this->getSingleRecord = true;
			if ($records[0]['templatefile']) {
				return $records[0]['typeofpost'].'/'.$records[0]['templatefile'];
			} else {
				return $records[0]['typeofpost'].'/detail.phtml';
			}
		}
		
		return 'homepage.phtml';
	}
	
	public function getRecords()
	{
		if ($this->getSingleRecord) {
			return $this->records[0];
		}
		
		return $this->records;
	}
		
		private function setRecordsCount()
		{
			if ( is_array($this->records) ) {
				$this->postsRecordsCount = count($this->records);
			}
		}
	
	public function getRecordsCount()
	{
		return $this->recordsCount;
	}
}
