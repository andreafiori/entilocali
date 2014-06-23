<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * TextShortener - ZF2 ViewHelper
 * $this->TextShortener('Text',10,100,'...');
 *
 * @autor Daniel Salvagni <danielsalvagni@gmail.com>
 */
class TextShortener extends AbstractHelper
{
    /**
     * Will truncate the string with both words and chars count
     * 
     * @param type $text
     * @param type $words
     * @param type $chars
     * @return type
     */
    protected function both($text, $words, $chars)
    {
        $explodeWords = preg_split('/[\s,]+/', $text);
        if(!count($explodeWords)) return substr($text,0,$chars);

        $newText = "";
        $i       = 1;
        foreach($explodeWords as $word):
            if((strlen($newText)<$chars) || ($i < $words))
                    $newText .= " {$word}";
            else break;
            $i++;
        endforeach;
        return $newText;
    }
    
    /**
     * Will truncate the string with the words count 
     * 
     * @param type $text
     * @param type $words
     * @return type
     */
    protected function words($text, $words)
    {
        return preg_replace('/((\w+\W*){'.$words.'}(\w+))(.*)/', '${1}', $text);
    }
    
    /**
     * 
     * @param type $text
     * @param type $chars
     * @return type
     */
    protected function chars($text, $chars)
    {
        if(strlen($text) < $chars) {
            return $text;
        } else {
            return substr($text, 0, strpos(substr($text, 0, $chars), ' '));
        }
    }
 
    /**
     * Invoke the class as a function to execute the actions
     * 
     * @param type $text
     * @param type $words
     * @param type $chars
     * @param type $end
     * @return type
     */
    public function __invoke($text, $words=false, $chars=false, $end="...")
    {
        if($words && $chars):
                $string = $this->both($text,$words,$chars);
        elseif($words && !$chars):
                $string = $this->words($text,$chars);
        elseif($chars && !$words):
                $string = $this->chars($text,$chars);
        else: 
                $string  = $text;
        endif;
        $endChar = (!$end) ? null : $end;
        return ($string != $text) ? rtrim($string,'.,;:?!¿¡').$endChar : $string ;
    }
}