<?php

namespace Posts\Model;

use Setup\DQLQueryHelper;

/**
 * Posts Query Builder
 * @author Andrea Fiori
 * @since  03 January 2014
 */
class PostsQueryBuilder extends DQLQueryHelper {

	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect('DISTINCT(p.id) AS postid, p.typeofpost, p.alias, po.title, p.status, po.description, po.seoUrl, po.seoKeywords, co.name');
		}
		
		$this->queryBasic = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\PostsOptions po, Application\\Entity\\Posts p,
					Application\\Entity\\PostsRelations r, Application\\Entity\\Categories c, Application\\Entity\\CategoriesOptions co
			WHERE (po.posts = p.id AND p.id = r.posts AND c.id = r.category
					AND co.category = c.id
			AND r.category = c.id AND r.channel = :channel
			AND co.language = :language AND po.language = :language ) ";
	}
	
	public function setBasicBindParameters()
	{
		$this->setBindParameters( array(
				'language'	=> 1, // TODO: get languageID from setup manager
				'channel'	=> $this->getSetupManager()->getChannelId()
			)
		);
	}

	public function setCategoryName($categoryName)
	{
		$this->query .= "AND co.name = :cname ";
		$this->addToBindParameters('cname', $categoryName);
	}

	public function setId($postsId)
	{
		$postsId = (int) $postsId;
		$this->query .= "AND p.id = :postsid ";
		$this->addToBindParameters('postsid', $postsId);
	}

	public function setTitle($title)
	{
		$this->query .= "AND po.title = :title ";
		$this->addToBindParameters('title', $title);
	}
	
	public function setStatus($status)
	{
		$this->query .= "AND p.status = :status ";
		$this->addToBindParameters('status', $status);
	}
	
	public function setAliasNotNull()
	{
		$this->query .= "AND p.alias IS NOT NULL AND p.alias != '' ";
	}
}