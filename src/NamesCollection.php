<?php

namespace Names;

class NamesCollection
{
    private array $names = [];

    public function addName(Name $name): void
    {
        $this->names[] = $name;
    }

    public function getNames(): array
    {
        return $this->names;
    }
}