<?php

class DictionaryWord {
    public string $id;
    public string $gyy;
    public string $clean;

    public string $type;
    public function __construct(string $id, string $gyy, string $type) {
        $this->id = $id;
        $this->gyy = $gyy;
        $clean = strtolower($gyy);
        $clean = preg_replace("/[^a-z]/","", $clean);
        $this->clean = strtolower($clean);
        $this->type = $type;
    }

    public function __toString(): string {
        return "{$this->id} {$this->gyy}";
    }
}
