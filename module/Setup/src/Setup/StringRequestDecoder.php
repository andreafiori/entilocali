<?php

namespace Setup;

/**
 * @author  Andrea Fiori
 * @since   07 May 2013
 */
class StringRequestDecoder {

	/**
	 * @param string $str
	 */
	public function normalize($str)
	{
		$str = $this->seoFormat($str);
		return $str;
	}

	/**
	 * @param string $str
	 */
	public function denormalize($str)
	{
		$str = $this->seoFormat($str);
		return stripslashes($str);
	}

	/**
	 * basic string replace for seo
	 * @param string $str
	 */
	private function seoFormat($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		$text = trim($text, '-');

		// transliterate
		if (function_exists('iconv'))
		{
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		}

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		if (empty($text)) return false;
	  
		return $text;
	}
}
