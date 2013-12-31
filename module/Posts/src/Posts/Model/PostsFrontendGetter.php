<?php

namespace Posts\Model;

use Categories\Model\CategoriesRepository;
use Application\Entity\Categories;

class entityManagerQueryBuilderAbstract {

	private $title, $categoryName;
	private $partialLayout = 'contents/detail.phtml';
	
	public function setTitle($title)
	{
		$this->title = $title;
		
		return $this->title;
	}
	
	public function setCategoryName($categoryName)
	{
		$this->categoryName = $categoryName;
		
		return $this->categoryName;
	}
	
	public function getPosts()
	{
		return $posts;
	}
	
	public function getCategoryFromRepository()
	{
		$categories = new CategoriesRepository($this->entityManager);
		return $categories->getFindFromRepository( array("name" => $this->getCategoryName()) );
	}
	
	public function getPostsListFromRelationRepository()
	{
		
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function getCategoryName()
	{
		return $this->categoryName;
	}
}