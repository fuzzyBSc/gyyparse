<?php

require_once dirname(__FILE__) ."/Dictionary.php";
require_once dirname(__FILE__) ."/AttemptedCompoundWordMatch.php";

class SuffixedWordMatch {
    public string $gyy;
    public array $matches;

    public function __construct(string $gyy, Dictionary $dictionary) {
        $this->gyy = $gyy;
        $wordBreakdowns = $dictionary->suffixes->strip($gyy);
        $this->matches = [];
        foreach ($wordBreakdowns as $breakdown) {
            $attemptedMatches = [];
            foreach ($breakdown as $component) {
                var_dump($breakdown);
                $attemptedMatch = new AllMatchesForWord($component, $dictionary);
                $attemptedMatches[] = $attemptedMatch->bestMatch();
            }
            $attemptedMatch = new AttemptedCompoundWordMatch($gyy, $attemptedMatches);
            $this->matches[] = $attemptedMatch;
        }
        usort($this->matches, 'AttemptedCompoundWordMatch::cmp');
    }

    public function bestMatch(): AttemptedWordMatch {
        return $this->matches[0];
    }

    public function __toString(): string {
        return "{$this->gyy}+{$this->bestMatch()}...";
    }

    public function print() {
        for ($ii = 0; $ii < 5 && $ii < count($this->matches); $ii++) {
            echo $this->matches[$ii] ."\r\n";
        }
    }
}
