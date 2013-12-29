<?php

namespace Posts\Model;

use Doctrine\ORM\EntityManager;
use Setup\StringRequestDecoder;

/**
 * Get All Posts with Alias
 * @author Andrea Fiori
 * @since  30 December 2013
 */
class postsAliasGetter {
	
	private $entityManager;
	private $remotelink;
	
	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}
	
	public function setRemotelink($remotelink)
	{
		$this->remotelink = $remotelink;
	}
	
	/**
	 * 
	 * @return boolean|multitype:unknown
	 */
	public function getPostsAlias($arraySearch = null, array $orderBy = null, $limit = null, $offset = null)
	{
		$postsRepository = new PostsRepository($this->entityManager);
		$posts = $postsRepository->getFindFromRepository($arraySearch, $orderBy, $limit, $offset);
		
		if (!$posts) return false;
		
		$posts = $postsRepository->convertArrayOfObjectToArray($posts);
		
		//$stringRequestDecoder = new StringRequestDecoder();
		
		$arrayToReturn = array();
		foreach($posts as $posts) {
			if ($posts['alias']) {				
				// TODO: get category and remotelink 
				//$posts['linkDetails'] = '/'.$this->remotelink.$stringRequestDecoder->normalize($this->categoryName).'/';
				//if ($this->categoryName!=$posts['title']) $posts['linkDetails'] .= $stringRequestDecoder->normalize($posts['title']);
				$arrayToReturn[$posts['alias']] = $posts;
			}
		}
		
		return $arrayToReturn;
	}
}