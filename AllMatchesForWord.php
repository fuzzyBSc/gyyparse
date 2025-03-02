<?php

require_once dirname(__FILE__) ."/Dictionary.php";
require_once dirname(__FILE__) ."/AttemptedWordMatch.php";

class AllMatchesForWord {
    public string $gyy;
    public array $matches;

    public function __construct(string $gyy, Dictionary $dictionary) {
        $this->gyy = $gyy;
        $this->matches = [];
        foreach ($dictionary->words as $word) {
            $attempt = new AttemptedWordMatch($gyy, $word);
            $this->matches[] = $attempt;
        }
        usort($this->matches, 'AttemptedWordMatch::cmp');
    }

    public function bestMatch(): AttemptedWordMatch {
        return $this->matches[0];
    }

    public function __toString(): string {
        return "{$this->gyy}+{$this->matches[0]}...";
    }

    public function print() {
        for ($ii = 0; $ii < 5 && $ii < count($this->matches); $ii++) {
            echo $this->matches[$ii] ."\r\n";
        }
    }
}
