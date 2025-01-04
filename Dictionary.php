<?php

require_once(dirname(__FILE__) ."/DictionaryWord.php");

class Dictionary {
    public array $words;
    public static function readHtml($filename) {
        $dictionarywords = file_get_contents($filename);
        $DOM = new DOMDocument;
        $DOM->loadHTML(source: $dictionarywords);
        
        $finder = new DomXPath($DOM);
        $entries = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' entry ')]");
        
        $result = [];
        foreach( $entries as $entry ) {
            $gyy = $finder->query(
                "./div/*[contains(concat(' ', normalize-space(@class), ' '),
                ' hw ')]",
                $entry);
            $word = new DictionaryWord(
                $entry->attributes->getNamedItem("id")->nodeValue,   
                $gyy->item(0)->nodeValue
                );
            array_push($result, $word);
        }
        return new Dictionary($result);
    }

    public function __construct(array $words) {
        $this->words = $words;
    }

    public function __toString(): string {
        return "{$this->words[0]}...";
    }
}
