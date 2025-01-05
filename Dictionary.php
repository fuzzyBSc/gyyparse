<?php

require_once dirname(__FILE__) ."/DictionaryWord.php";

class Dictionary {
    public array $words;
    public array $suffixes;

    public static function readHtmlFile($filename) {
        $dictionarywords = file_get_contents($filename);
        $DOM = new DOMDocument;
        $DOM->loadHTML(source: $dictionarywords);
        
        return Dictionary::readHtmlDom($DOM);
    }

    public static function readHtmlDom($DOM) {
        $finder = new DomXPath($DOM);
        $entries = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' entry ')]");
        
        $words = [];
        foreach( $entries as $entry ) {
            $gyy = $finder->query(
                "./div/*[contains(concat(' ', normalize-space(@class), ' '),
                ' hw ')]",
                $entry);
            $type = $finder->query(
                "./div/*[contains(concat(' ', normalize-space(@class), ' '),
                ' ps ')]",
                $entry);
            $word = new DictionaryWord(
                $entry->attributes->getNamedItem("id")->nodeValue,   
                $gyy->item(0)->nodeValue,
                $type->item(0)->nodeValue
                );
            array_push($words, $word);
        }
        $suffixes = array_filter($words, function($word) {
            return $word->type == "suff";
        });
        return new Dictionary($words, $suffixes);
    }

    public function __construct(array $words, array $suffixes) {
        $this->words = $words;
        $this->suffixes = $suffixes;
    }

    public function __toString(): string {
        return "{$this->words[0]}...";
    }
}
