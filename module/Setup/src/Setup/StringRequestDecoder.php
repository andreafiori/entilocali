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
	public static function slugify($str)
	{
		$str = self::seoFormat($str);
		return $str;
	}

	/**
	 * @param string $str
	 */
	public static function deSlugify($str)
	{
		$str = self::seoFormat($str);
		$str = stripslashes($str);
		$str = str_replace('-', ' ', $str);
		return $str;
	}

	/**
	 * basic string replace for seo
	 * @param string $str
	 */
	private static function seoFormat($text)
	{
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		$text = trim($text, '-');

		if (function_exists('iconv'))
		{
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		}

		$text = preg_replace('~[^-\w]+~', '', $text);

		if (empty($text)) return false;
	  
		return $text;
	}
}
