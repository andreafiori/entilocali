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
	 *
	 * @throws NullException
	 * @return LanguagesSetup
	 */
	public function setLanguagesLabels()
	{
		if (!$this->getLanguageLabelsRepository()) {
			throw new NullException('Language Labels Repository is not set');
		}

		$this->languagesLabels = $this->getLanguageLabelsRepository()->getLabels(
				array("language" => $this->getDefaultLanguage('id') ? $this->getDefaultLanguage('id') : 1 )
		);

		return $this->languagesLabels;
	}

	public function getLanguageLabels()
	{
		return $this->languagesLabels;
	}
}
