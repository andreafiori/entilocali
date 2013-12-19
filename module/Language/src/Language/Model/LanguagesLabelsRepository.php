<?php

namespace Language\Model;

use Setup\Model\EntityRepositoryAbstract;

class LanguagesLabelsRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\LanguagesLabels';
	
	public function setLabelsForActiveLanguage()
	{
		
	}
}