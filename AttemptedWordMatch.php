<?php

require_once dirname(__FILE__) ."/DictionaryWord.php";

class AttemptedWordMatch {
    public string $gyy;
    public DictionaryWord $match;
    public int $score;

    public function __construct(string $gyy, DictionaryWord $match) {
        $this->gyy = $gyy;
        $this->match = $match;
        $this->score = levenshtein(strtolower($gyy), $match->clean);
    }

    public static function cmp(AttemptedWordMatch $a, AttemptedWordMatch $b): int {
        return $a->score <=> $b->score;
    }

    public function __toString(): string {
        return "{$this->gyy}+{$this->match} = {$this->score}";
    }
}
