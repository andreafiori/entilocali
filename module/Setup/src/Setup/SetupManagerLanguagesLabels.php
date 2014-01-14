<?php

namespace Setup;

use Setup\SetupManagerAbstract;
use Languages\Model\LanguagesLabelsRepository;
use Setup\NullException;

/**
 * 
 * @author Andrea Fiori
 * @since  13 January 2014
 */
class SetupManagerLanguagesLabels extends SetupManagerAbstract
{
	/**
	 * @param LanguagesLabelsRepository $languagesLabelsRepository
	 */
	public function setLanguagesLabelsRepository(LanguagesLabelsRepository $languagesLabelsRepository)
	{
		$this->languageLabelsRepository = $languagesLabelsRepository;
	
		return $this->languageLabelsRepository;
	}
	
	public function getLanguageLabelsRepository()
	{
		return $this->languageLabelsRepository;
	}

	/**
	 * @throws NullException
	 * @return LanguagesSetup
	 * @param  int $languageId
	 */
	public function setLanguagesLabels($languageId = 1)
	{
		$labelsRepository = $this->getLanguageLabelsRepository();
		if (!$labelsRepository) {
			throw new NullException('Language Labels Repository is not set');
		}
	
		$this->languagesLabels = $labelsRepository->getLabels( array("language" => $languageId ) );

		return $this->languagesLabels;
	}
	
	public function getLanguageLabels()
	{
		return $this->languagesLabels;
	}
}
