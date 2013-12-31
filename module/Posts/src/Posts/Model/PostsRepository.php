<?php

namespace Posts\Model;

use Setup\QueryMakerAbstract;

/**
 * @author Andrea Fiori
 * @since  24 December 2013
 */
class PostsRepository extends QueryMakerAbstract {
	
	protected $repository = 'Application\Entity\Posts';
	
}