<?php

declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\Calculator;
use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function empty_number(){
        $calculator = new Calculator();

        $result = $calculator->calculate("");

        $this->assertEquals("0", $result);
    }
    /**
     * @test
     */
    public function given_1_number(){
        $calculator = new Calculator();

        $result = $calculator->calculate("1.1");

        $this->assertEquals("1.1", $result);
    }
    /**
     * @test
     */
    public function given_multiple_number(){
        $calculator = new Calculator();

        $result = $calculator->calculate("1.1,2.3,7");

        $this->assertEquals("10.4", $result);
    }

}
