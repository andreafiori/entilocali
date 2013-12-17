<?php

namespace Language\Model;

use Doctrine\Common\Persistence\ObjectManager;

class LanguageRepository {
	
	private $em;
	
	private $repository = 'Application\Entity\Languages';
	
	public function __construct(ObjectManager $objectManager)
	{
		$this->em = $objectManager;
	}
	
	public function getRecord($channelId = 1)
	{
		return $this->em->getRepository($this->repository)->findOneBy( array('active' => 1, 'channelId' => $channelId) );
	}
	
	/**
	 * 
	 * @param string $abbreviation
	 * @return \Application\Entity\Language $objLang 
	 */
	public function getRecordFromLanguageAbbreviation($abbreviation = null)
	{
		return $this->em->getRepository($this->repository)->findOneBy( array('active' => 1, 'abbrev1' => $abbreviation) );
	}
}