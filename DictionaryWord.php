<?php

class DictionaryWord {
    public string $id;
    public string $gyy;
    public string $clean;

    public string $type;
    public function __construct(string $id, string $gyy, string $type) {
        $this->id = $id;
        $this->gyy = $gyy;
        // Case insensitive
        $clean = strtolower($gyy);
        // Treat pure suffix words as ordinary words
        if (str_starts_with($clean,"-")) {
            $clean = substr($clean,1);
        } else if (str_starts_with($clean,"=")) {
            $clean = substr($clean,1);
        }
        // Strip final suffix from word, eg stripping verbs down to their root
        $clean = preg_replace("/-[^-]*$/","", $clean);
        // Remove any remaining formatting
        $clean = preg_replace("/[^a-z]/","", $clean);
        $this->clean = strtolower($clean);
        $this->type = $type;
    }

    public function __toString(): string {
        return "{$this->id} {$this->gyy}";
    }
}
