<?php

namespace Posts\Model;

use Setup\QueryMakerAbstract;

/**
 * Get All Posts with Alias
 * @author Andrea Fiori
 * @since  30 December 2013
 */
class PostsAliasGetter extends QueryMakerAbstract {
	
	private $remotelink;
	
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
		
		$arrayToReturn = array();
		foreach($posts as $posts) {
			if ($posts['alias']) {	
				// TODO: get link details, link for each available language
				//$posts['linkDetails'] = '/'.$this->remotelink.$stringRequestDecoder->normalize($this->categoryName).'/';
				//if ($this->categoryName!=$posts['title']) $posts['linkDetails'] .= $stringRequestDecoder->normalize($posts['title']);
				$arrayToReturn[$posts['alias']] = $posts;
			}
		}
		
		return $arrayToReturn;
	}
}