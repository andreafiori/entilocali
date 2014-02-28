<?php

namespace Setup;

/**
 * @author  Andrea Fiori
 * @since   07 May 2013
 */
class StringRequestDecoder
{
	/**
	 * @param string $str
	 */
	public static function slugify($str)
	{
		$str = self::seoFormat($str, '-');
		return $str;
	}

	/**
	 * @param string $str
	 */
	public static function deSlugify($str)
	{
		$str = self::seoFormat($str);
		return $str;
	}
	
		/**
		 * @param string $str
		 * @param string $trimChar
		 * @return string
		 */
		private static function seoFormat($str, $trimChar = ' ')
		{
			if ( is_string($str) ) {
				if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') ) {
					$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
				}
				$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
				$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
				$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
				$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), $trimChar, $str);
				$str = strtolower( trim($str, $trimChar) );
			}
			
			return $str;
		}
}
