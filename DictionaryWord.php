<?php

class DictionaryWord {
    public string $id;
    public string $gyy;
    public string $clean;
    public function __construct(string $id, string $gyy) {
        $this->id = $id;
        $this->gyy = $gyy;
        $this->clean = strtolower($gyy);
    }

    public function __toString(): string {
        return "{$this->id} {$this->gyy}";
    }
}
