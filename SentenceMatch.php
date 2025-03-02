<?php

require_once dirname(__FILE__) ."/Dictionary.php";
require_once dirname(__FILE__) ."/CompoundWordMatch.php";

class SentenceMatch {
    public string $gyy;
    public array $matches;

    public function __construct(string $gyy, Dictionary $dictionary) {
        $this->gyy = $gyy;

        $words = preg_split("/[^a-zA-Z=-]+/", $gyy);
        // print implode("/", $words);
        $this->matches = [];
        foreach ($words as $word) {
            if ($word !== '') {
                $this->matches[] = new CompoundWordMatch($word, $dictionary);
            }
        }
    }
    
    public function __toString(): string {
        $matches = implode($this->matches);
        return "{$this->gyy}+{$matches}...";
    }

    public function print() {
        echo "{$this->gyy}\r\n";
        $wordsep = "";
        // var_dump($this->matches);
        foreach ($this->matches as $word) {
            echo $wordsep;
            echo $word->bestMatch();
            $wordsep = " ";
        }
        echo "\r\n";
    }
}
