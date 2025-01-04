<?php

class Sentence {
    public string $gyy;
    public array $split;
    public static function readHtml($filename) {
        $testdata = file_get_contents($filename);
        $DOM = new DOMDocument;
        $DOM->loadHTML(source: $testdata);
        
        $finder = new DomXPath($DOM);
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' orth ')]");
        
        $result = [];
        foreach($nodes as $node) {
            $sentence = new Sentence($node->nodeValue);
            array_push($result, $sentence);
        }
        return $result;
    }

    public function __construct(string $gyy) {
        $this->gyy = $gyy;
        $clean = $result = preg_replace("/[^a-zA-Z\s]+/", "", $gyy);
        $this->split = preg_split("/\s+/", $clean, 10);
    }

    public function __toString(): string {
        return $this->gyy;
    }
}
