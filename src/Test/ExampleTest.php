<?php

namespace PHPUnitPrinter\Test;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    public function testSuccessExample(): void
    {
        $this->assertTrue(true);
    }

    public function testFailExample() : void
    {
        $this->assertTrue(false);
    }

    public function testErrorExample() : void
    {
        throw new \Exception('Error example');
    }

}