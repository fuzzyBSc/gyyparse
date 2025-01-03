<?php

class Sentence {
    public string $gyy;
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
    }

    public function __toString(): string {
        return $this->gyy;
    }
}
