<?php

namespace Tests\Fixtures;

use Trivia\OutputInterface;

class ArrayOutput implements OutputInterface {

    private $lines = [];

    /**
     * @inheritDoc
     */
    public function write(string $line): void
    {
        $this->lines[] = $line;
    }

    /**
     * @return array
     */
    public function getLines() : array
    {
        return $this->lines;
    }
}