<?php

require_once dirname(__FILE__) ."/DictionaryWord.php";

class Suffixes {
    public array $suffixes;
    public array $uniqueCleanSuffixStrings;

    public function __construct(array $words) {
        $suffixes = array_filter($words, function($word) {
            return $word->type == "suff";
        });
        $this->suffixes = $suffixes;
        $allCleanSuffixes = array_map(function($suffix) {
            return $suffix->clean;
        }, $suffixes);
        $this->uniqueCleanSuffixStrings = array_unique($allCleanSuffixes);
    }

    public function strip(string $word): array {
        $result = [];
        $this->stripRecursive($result, $word, []);
        return $result;
    }

    private function stripRecursive(array &$result, string $word, array $context) {
        foreach ($this->uniqueCleanSuffixStrings as $suffix) {
            if (
                strlen($word) > strlen($suffix) &&
                str_ends_with($word, $suffix)) {
                // echo "{$word} matches {$suffix}\r\n";
                $childContext = $context;
                array_unshift($childContext, $suffix);
                $this->stripRecursive(
                    $result,
                    $this->remove($word, $suffix),
                $childContext); 
            }
        }
        array_unshift($context, $word);
        $result[] = $context;
    }

    private function remove(string $word, string $suffix) {
        // This is probably wrong, because removing a suffix likely requires us to add the future tense suffix back in
        return substr($word, 0, -strlen($suffix));
    }

    public function __toString(): string {
        return "{$this->suffixes[0]}...";
    }
}
