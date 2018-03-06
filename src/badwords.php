<?php namespace Buchin\Badwords;

/**
* 
*/
class Badwords
{
	public static function isDirty($string)
	{
		$words = explode(' ', $string);

		$bad_words = self::getBadWords();

		foreach ($words as $word) {
			if(in_array(strtolower($word), $bad_words)){
				return true;
			}
		}

		return false;
	}

	public static function strip($string)
	{
		$words = explode(' ', $string);

		$bad_words = self::getBadWords();

		$new_words = [];

		foreach ($words as $word) {
			if(in_array(strtolower($word), $bad_words)){
				$new_words[] = str_ireplace(['a', 'i', 'u', 'e', 'o', '4', '1', '3', '0'], '*', $word);
			}
			else{
				$new_words[] = $word;
			}
		}

		return implode(' ', $new_words);
	}

	public static function getBadWords()
	{
		return array_map(function($item){
			return strtolower(trim($item));
		}, explode("\n", file_get_contents(__DIR__ . '/badwords.txt')));
	}
}