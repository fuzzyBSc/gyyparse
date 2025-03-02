<?php

require_once dirname(__FILE__) ."/Dictionary.php";
require_once dirname(__FILE__) ."/AttemptedWordMatch.php";

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
                $matches = new AllMatchesForWord($word, $dictionary);
                $this->matches[] = $matches;
            }
        }
    }
    
    public function getDictionaryWords(): array {
        $words = [];
        for ($ii = 0; $ii < count($this->matches); $ii++) {
            array_push($words, $this->matches[$ii]->bestMatch()->getDictionaryWord());
        }
        return $words;
    }

    public function __toString(): string {
        $matches = implode($this->matches);
        return "{$this->gyy}+{$matches}...";
    }

    public function print() {
        echo "{$this->gyy}\r\n";
        $words = $this->getDictionaryWords();
        for ($ii = 0; $ii < count($words); $ii++) {
            echo $words[$ii] ." ";
        }
        echo "\r\n";
    }
}
