<?php

namespace Posts\Model;

use Setup\Model\EntityRepositoryAbstract;

/**
 * @author Andrea Fiori
 * @since  24 December 2013
 */
class PostsRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\Posts';
	
}