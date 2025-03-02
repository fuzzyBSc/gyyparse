<?php

require_once dirname(__FILE__) ."/AttemptedWordMatch.php";

class AttemptedCompoundWordMatch {
    public string $gyy;
    public array $matches;
    public int $score;

    public function __construct(string $gyy, array $matches) {
        $this->gyy = $gyy;
        $this->matches = $matches;
        $this->score = 0;
        for ($ii = 0; $ii < count($matches); $ii++) {
            $this->score += $matches[$ii]->score;
        }
    }

    public function getAttemptedWordMatches(): array {
        return $this->matches;
    }

    public static function cmp(AttemptedCompoundWordMatch $a, AttemptedCompoundWordMatch $b): int {
        return $a->score <=> $b->score 
            ?: count($a->matches) <=> count($b->matches);
    }

    public function __toString(): string {
        $matches = "";
        $sep = "";
        foreach ($this->matches as $match) {
            $dictionaryWord = $match->match;
            $matches .= $sep . $dictionaryWord->id . "." . $dictionaryWord->clean;
            $sep = "-";
        }
        return "{$this->gyy}:{$matches}={$this->score}";
    }
}
