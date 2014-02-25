<?php

namespace Posts\Model;

use Setup\DQLQueryHelper;

/**
 * @author Andrea Fiori
 * @since  03 January 2014
 */
class PostsQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect('DISTINCT(p.id) AS postid, po.id AS postoptionid, p.typeofpost, p.alias, po.title, p.status, po.description, po.seoUrl, po.seoDescription, po.seoKeywords, p.templatefile, co.name');
		}
		
		$this->queryBasic = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\PostsOptions po, Application\\Entity\\Posts p,
					Application\\Entity\\PostsRelations r, Application\\Entity\\Categories c, Application\\Entity\\CategoriesOptions co
			WHERE (po.posts = p.id AND p.id = r.posts AND c.id = r.category
					AND co.category = c.id 
				AND r.category = c.id AND r.channel = :channel 
				AND po.language = :language 
			) "; // AND DATE_FORMAT(po.datefrom, '%Y-%m-%d') < CURRENT_DATE()
	}

	public function setId($id)
	{
		if ( !is_numeric($id) ) {
			return false;
		}
	
		$this->query .= "AND p.id = :postid ";
		$this->addToBindParameters('postid', $id);
	}
	
	public function setBasicBindParameters()
	{
		$this->setBindParameters( array('channel' => $this->getSetupManager()->getChannelId(), 'language' => $this->getSetupManager()->getSetupManagerLanguages()->getLanguageId() ) );
	}
	
	public function setLanguage($languageId)
	{
		if (!$languageId or !(int) $languageId) {
			return false;
		}
		
		$this->query .= "AND co.language = :language AND po.language = :language ";
		$this->addToBindParameters('language', $languageId);
	}

	public function setCategoryName($categoryName)
	{
		if (!$categoryName) {
			return false;
		}
		
		$this->query .= "AND co.name = :cname ";
		$this->addToBindParameters('cname', $categoryName);
	}

	public function setCategorySeoUrl($categoryName)
	{
		if ($categoryName) {
			$this->query .= "AND co.seoUrl = :seourlcategory ";
			$this->addToBindParameters('seourlcategory', $categoryName);
		}		
	}

	public function setTitle($title)
	{
		if ($title) {
			$this->query .= "AND po.title = :title ";
			$this->addToBindParameters('title', $title);
		}
	}
	
	/**
	 * pass the same as the title to get the "slugged" title
	 * @param string $title
	 * @return boolean
	 */
	public function setSeoUrl($seoUrl)
	{
		if ($seoUrl) {
			$this->query .= "AND po.seoUrl = :seourl ";
			$this->addToBindParameters('seourl', $seoUrl);
		}
	}
	
	public function setStatus($status)
	{
		if ($status === null) {
			$this->query .= "AND p.status IS NULL ";
		} else {
			$this->query .= "AND p.status = :status ";
		}
		
		$this->addToBindParameters('status', $status);
	}
	
	public function setAliasNotNull($setAlias = false)
	{
		if ($setAlias) {
			$this->query .= "AND p.alias IS NOT NULL AND p.alias != '' ";
		}
	}
	
	public function setParentId($parentId)
	{
		$this->query .= "AND p.parentId = :parentid ";
		$this->addToBindParameters('parentid', $parentId ? $parentId : 0);
	}
	
	public function setParentIdCategory($parentIdCat)
	{
		$this->query .= "AND co.parentId = :parentIdCat ";
		$this->addToBindParameters('parentIdCat', $parentIdCat ? $parentIdCat : 0);
	}
}