<?php


namespace Trivia;

/**
 * Class ConsoleOutput
 *
 * @package Trivia
 */
class ConsoleOutput implements OutputInterface
{

    /**
     * @inheritDoc
     */
    public function write(string $line): void
    {
        echo "$line\n";
    }
}