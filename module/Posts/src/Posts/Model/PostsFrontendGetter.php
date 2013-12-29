<?php

namespace Posts\Model;

use Categories\Model\CategoriesRepository;
use Application\Entity\Categories;

class PostsFrontendGetter {

	private $entityManager, $title, $categoryName;
	
	private $partialLayout = 'contents/detail.phtml';
	
	public function setEntityManager($entityManager)
	{
		$this->entityManager = $entityManager;

		return $this->entityManager;
	}
	
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
		$categories = $this->getCategoryFromRepository();
		
		// Se non trova la categoria, stop e rimanda a pagina con messaggio oppure redirect
		if (!$categories) {
			return false;
		}
		
		$categoryEntity = new Categories();
		$categoryEntity->setId($categories[0]['id']);
		
		// se non trova nulla fra le relazioni, redirect
		$postsRelations = new PostsRelationsRepository($this->entityManager);
		$postsList = $postsRelations->getFindFromRepository(array("category"=>$categoryEntity));
		
		if (!$postsList) {
			return false;
		}
		
		// posts trovati sulle relazioni possono essere + di uno
		$postsRepository = new PostsRepository($this->entityManager);
		$posts = $postsRepository->getFindFromRepository(array("id" => $postsList[0]['id']));
		
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