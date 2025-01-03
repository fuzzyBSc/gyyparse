<?php

class Word {
    public string $id;
    public string $gyy;
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
            $word = new Word();
            $word->id = $entry->attributes->getNamedItem("id")->nodeValue;   
            $word->gyy = $gyy->item(0)->nodeValue;
            array_push($result, $word);
        }
        return $result;
    }

    public function __toString(): string {
        return "{$this->id} {$this->gyy}";
    }
}
