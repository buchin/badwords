<?php namespace Buchin\Badwords;

class Badwords
{
    const NEGATOR = ["aint", "arent", "cannot", "cant", "couldnt", "darent", "didnt", "doesnt",
        "ain't", "aren't", "can't", "couldn't", "daren't", "didn't", "doesn't",
        "dont", "hadnt", "hasnt", "havent", "isnt", "mightnt", "mustnt", "neither",
        "don't", "hadn't", "hasn't", "haven't", "isn't", "mightn't", "mustn't",
        "neednt", "needn't", "never", "no", "none", "nope", "nor", "not", "nothing", "nowhere",
        "oughtnt", "shant", "shouldnt", "uhuh", "wasnt", "werent",
        "oughtn't", "shan't", "shouldn't", "uh-uh", "wasn't", "weren't",
        "without", "wont", "wouldnt", "won't", "wouldn't", "rarely", "seldom", "despite"];

    const ARTICLE = ["a", "an", "the"];


    public static function isDirty($string)
    {
        $words = explode(" ", $string);

        $bad_words = self::getBadWords();
        $bad_phrases = self::getBadPhrases();

        foreach ($bad_phrases as $bad_phrase) {
            if (strpos($string, $bad_phrase) !== false) {
                return true;
            }
        }

        foreach ($words as $word) {
            if (in_array(strtolower($word), $bad_words)) {
                return true;
            }
        }

        return false;
    }

    public static function strip($string)
    {
        $words = explode(" ", $string);

        $bad_words = self::getBadWords();

        $new_words = [];

        foreach ($words as $word) {
            if (in_array(strtolower($word), $bad_words)) {
                $new_words[] = str_ireplace(
                    ["a", "i", "u", "e", "o", "4", "1", "3", "0"],
                    "*",
                    $word
                );
            } else {
                $new_words[] = $word;
            }
        }

        return implode(" ", $new_words);
    }

    public static function getBadWords()
    {
        return array_map(function ($item) {
            return strtolower(trim($item));
        }, explode("\n", file_get_contents(__DIR__ . "/badwords.txt")));
    }

    // Return a single bad word found in the sentence
    public static function getBadword($sentence)
    {
        $isDirty = self::isDirty($sentence);
        
        // List of badwords
        $getBadWords = self::getBadWords();
        if($isDirty == 1)
        {
        // Offensive word is found
        // return the word 
            $sentenceArray = explode(" ", strtolower($sentence));
            for($i = 0; $i < count($sentenceArray); $i++)
                    for ($k=0; $k < count($getBadWords); $k++) { 
                    
                    {
                            if ($sentenceArray[$i] == $getBadWords[$k]) {
                                return $getBadWords[$k];
                            }
                    }
            }


        }
        return -1;     
    }

    public static function negationCheck($sentence)
    {
        $isBadWord = 1;
        $isNeutral = 0;
        $notFound = -1;
        
        $sentence = preg_replace('/(\s\s+|\t|\n)/', ' ', strtolower(trim($sentence)));
        $getBadWord = Badwords::getBadword(($sentence));
        if($getBadWord == -1)
        {
            return $notFound;
        }
        
        // Checking if the word b4 the offensive word is negator
        $findme = $getBadWord;
        $pos = strpos($sentence, $findme);
        $precedingWords = explode(" ",trim(substr($sentence, 0, $pos)));
        // Getting the last word in the array.
        $last_word = end($precedingWords);

        // check if it's an article b4 the fowl word
        if(Badwords::checkWord($last_word,'ARTICLE') == 1)
        {
            //Checking the word before the ARTICLE
            return Badwords::checkWord(prev($precedingWords),'NEGATOR') == 1 ? $isNeutral : $isBadWord;
        }
        
        return (Badwords::checkWord($last_word,'NEGATOR') == 1) ? $isNeutral : $isBadWord;
    }

    public static function checkWord($word,$const)
    {
        $constant = ($const == "NEGATOR") ? self::NEGATOR : self::ARTICLE;
        foreach($constant as $value)
        {
            if ($value == $word) {
                return 1;
            }
        }
        return -1;
    }

    public static function getBadPhrases()
    {
        $bad_words = self::getBadWords();

        $bad_phrases = [];

        foreach ($bad_words as $bad_word) {
            $words = explode(" ", $bad_word);

            if (count($words) > 1) {
                $bad_phrases[] = $bad_word;
            }
        }

        return $bad_phrases;
    }
}
