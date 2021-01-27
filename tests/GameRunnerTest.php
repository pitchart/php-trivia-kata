<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class GameRunnerTest extends TestCase
{
    public function testGoldenMaster()
    {
        srand(123);

        ob_start();
        include(__DIR__.'/../bin/game-runner.php');
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(file_get_contents(__DIR__.'/results/golden_master.txt'), $output);
    }
}