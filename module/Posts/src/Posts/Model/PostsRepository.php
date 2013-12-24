<?php

namespace Posts\Model;

use Setup\Model\EntityRepositoryAbstract;

/**
 * 
 * @author Andrea Fiori
 * @since  24 December 2013
 */
class PostsRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\Posts';
	
	/**
	 * Get Posts Result
	 * @param string $arraySelection
	 * @return array: 
	 */
	public function getPosts($arraySearch = null)
	{
		return $this->getFindFromRepository($arraySearch);
	}
}