<?php

namespace Posts\Model;

use Setup\EntityRepositoryAbstract;

/**
 * @author Andrea Fiori
 * @since  24 December 2013
 */
class PostsRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\Posts';
	
}