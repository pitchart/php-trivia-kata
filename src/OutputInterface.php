<?php


namespace Trivia;

/**
 * Interface OutputInterface
 *
 * @package Trivia
 */
interface OutputInterface {

    /**
     * @param string $line
     */
    public function write(string $line) : void;
}