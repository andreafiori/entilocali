<?php

namespace Language\Model;

use Setup\Model\EntityRepositoryAbstract;
use Doctrine\Common\Persistence\ObjectManager;

class LanguagesRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\Languages';
	
	private $defaultLanguage, $defaultLangFieldName;
	
	private $allAvailableLanguages;
	
	public function __construct(ObjectManager $objectManager)
	{
		parent::__construct($objectManager);
		if ($this->isOnBackend())
			$this->defaultLangFieldName = 'defaultlangAdmin';
		else
			$this->defaultLangFieldName = 'defaultlang';
	}
	
	/**
	 * @param string $abbreviation
	 * @return \Application\Entity\Language $objLang 
	 */
	public function setRecordFromLanguageAbbreviation($abbreviation)
	{
		$input = array('active' => 1);
		if ($abbreviation)
			$input['abbrev1'] = $abbreviation;
		else
			$input['defaultlang'] = 1;
		
		$record = $this->em->getRepository($this->repository)->findBy($input);
		if ($record)
			return $this->convertObjectToArray($record);
		else
			return null;
	}
	
	public function setAllAvailableLanguages()
	{
		$record = $this->em->getRepository($this->repository)->findBy( array("active" => 1, "channelId" => $this->input['channel']) );
		$record = $this->convertObjectToArray($record);
		$this->allAvailableLanguages = $record;
		return $record;
	}
	
	public function setDefaultLanguage()
	{
		if (!$this->allAvailableLanguages) return false;
		foreach($this->allAvailableLanguages as $availableLanguage)
		{
			if ($availableLanguage[$this->defaultLangFieldName])
				return $availableLanguage;
		}
	}
	
	public function getDefaultLanguage()
	{
		return $this->defaultLanguage;
	}
}